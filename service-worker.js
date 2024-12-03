const CACHE_NAME = "v2";
const urlsToCache = [
  "index.html",
  "offline.html",
  "app/",
  "assets/",
  "dist/",
  "fonts/",
  "js/",
  "libs/",
  "scss/",
  "tasks/",
  "autoload.php",
  "script.js",
  "https://cdn.jsdelivr.net/npm/sweetalert2@11",
  "https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap",
  "https://fonts.gstatic.com/s/roboto/v20/KFOmCnqEu92Fr1Mu4mxP.ttf",
 
];

self.addEventListener("install", (event) => {
    event.waitUntil(
      caches.open(CACHE_NAME).then((cache) => {
        return Promise.all(
          urlsToCache.map((url) =>
            cache.add(url).catch((err) => console.error(`Error al cachear ${url}:`, err))
          )
        );
      })
    );
  });
  
  self.addEventListener("activate", (event) => {
    const cacheWhitelist = [CACHE_NAME];
    event.waitUntil(
      caches.keys().then((cacheNames) => {
        return Promise.all(
          cacheNames.map((cacheName) => {
            if (!cacheWhitelist.includes(cacheName)) {
              return caches.delete(cacheName);
            }
          })
        );
      })
    );
  });
  
  self.addEventListener("fetch", (event) => {
    event.respondWith(
      caches.match(event.request).then((response) => {
        return response || fetch(event.request).catch(() => {
          return caches.match("offline.html");
        });
      })
    );
  });