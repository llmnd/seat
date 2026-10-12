const CACHE_NAME = "seat-opus-global-v1";
const OFFLINE_URL = new URL("./offline.html", self.location).toString();
const PRECACHE_URLS = [
  "./",
  "./index.php",
  "./manifest.webmanifest",
  "./offline.html",
  "./images/pwa-icon.svg",
  "./images/pwa-icon-192.png",
  "./images/pwa-icon-512.png"
];
const CACHEABLE_ASSET = /\.(?:avif|css|eot|gif|ico|jpe?g|js|png|svg|ttf|webp|woff2?)$/i;
const MAX_CACHED_ASSETS = 120;

self.addEventListener("install", (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => cache.addAll(PRECACHE_URLS))
  );
  self.skipWaiting();
});

self.addEventListener("activate", (event) => {
  event.waitUntil(Promise.all([
    caches.keys().then((cacheNames) => Promise.all(
      cacheNames
        .filter((cacheName) => cacheName.startsWith("seat-opus-global-") && cacheName !== CACHE_NAME)
        .map((cacheName) => caches.delete(cacheName))
    )),
    self.clients.claim()
  ]));
});

self.addEventListener("fetch", (event) => {
  const request = event.request;
  const requestUrl = new URL(request.url);

  if (request.method !== "GET" || requestUrl.origin !== self.location.origin) return;

  if (request.mode === "navigate") {
    event.respondWith(networkFirstPage(request));
    return;
  }

  if (CACHEABLE_ASSET.test(requestUrl.pathname)) {
    event.respondWith(networkFirstAsset(request));
  }
});

async function networkFirstPage(request) {
  const cache = await caches.open(CACHE_NAME);

  try {
    const response = await fetch(request);
    const contentType = response.headers.get("content-type") || "";
    const requestUrl = new URL(request.url);
    if (
      response.ok &&
      response.type === "basic" &&
      contentType.includes("text/html") &&
      !requestUrl.search
    ) {
      await cache.put(request, response.clone());
    }
    return response;
  } catch (error) {
    const cachedPage = await cache.match(request);
    if (cachedPage) return cachedPage;

    const offlinePage = await cache.match(OFFLINE_URL);
    if (offlinePage) return offlinePage;

    throw error;
  }
}

async function networkFirstAsset(request) {
  const cache = await caches.open(CACHE_NAME);

  try {
    const response = await fetch(request);
    if (response.ok && response.type === "basic") {
      await cache.put(request, response.clone());
      await trimAssetCache(cache);
    }
    return response;
  } catch (error) {
    const cachedAsset = await cache.match(request);
    if (cachedAsset) return cachedAsset;
    throw error;
  }
}

async function trimAssetCache(cache) {
  const requests = await cache.keys();
  const assetRequests = requests.filter((request) => {
    const pathname = new URL(request.url).pathname;
    return CACHEABLE_ASSET.test(pathname) && pathname !== "/offline.html";
  });

  await Promise.all(
    assetRequests
      .slice(0, Math.max(0, assetRequests.length - MAX_CACHED_ASSETS))
      .map((request) => cache.delete(request))
  );
}
