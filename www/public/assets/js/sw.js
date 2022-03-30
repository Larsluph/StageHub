importScripts(
    'https://storage.googleapis.com/workbox-cdn/releases/4.3.1/workbox-sw.js'
);
if (workbox) {
    console.log(`Super ! Workbox est chargé 🎉`);

    workbox.routing.registerRoute(
        /\.(?:html|js|css|png)$/,
        new workbox.strategies.StaleWhileRevalidate()
    );
}

// On install - caching the application shell
self.addEventListener('install', function(event) {
    event.waitUntil(
      caches.open('sw-cache').then(function(cache) {
        // cache any static files that make up the application shell
        return cache.add('acceuil.php');
      })
    );
  });
  
  // On network request
  self.addEventListener('fetch', function(event) {
    event.respondWith(
      // Try the cache
      caches.match(event.request).then(function(response) {
        //If response found return it, else fetch again
        return response || fetch(event.request);
      })
    );
  });