// var filesToCache = [
//   '/',
//   '/index.html',
//   '/materialize',
//   '/js/app.js'
// ];

var filesToCache = [];

var cacheName = 'ajudeVovo-v2';
var dataCacheName = 'ajudeVovoData-v2';

self.addEventListener('install', function(e) {
  console.log('[ServiceWorker] Install');
  e.waitUntil(
    caches.open(cacheName).then(function(cache) {
      console.log('[ServiceWorker] Caching app shell');
      return cache.addAll(filesToCache);
    })
  );
});

self.addEventListener('activate', function(e) {
  console.log('[ServiceWorker] Activate');
  e.waitUntil(
    caches.keys().then(function(keyList) {
      return Promise.all(keyList.map(function(key) {
        if (key !== cacheName && key !== dataCacheName) {
          console.log('[ServiceWorker] Removing old cache', key);
          return caches.delete(key);
        }
      }));
    })
  );


  return self.clients.claim();
});

// Push notificationss
self.addEventListener('push', function(event) {
  event.waitUntil(
    self.registration.showNotification('Ajude o vovô - Informa...', {
      body: 'Existem mais aviões no mar, que submarinos no céu!'
   }));
});

self.addEventListener('fetch', function(event) {
  event.respondWith(
    caches.match(event.request)
      .then(function(response) {
        // Cache hit - return response
        if (response) {
          return response;
        }

        // IMPORTANT: Clone the request. A request is a stream and
        // can only be consumed once. Since we are consuming this
        // once by cache and once by the browser for fetch, we need
        // to clone the response.
        var fetchRequest = event.request.clone();

        return fetch(fetchRequest).then(
          function(response) {
            // Check if we received a valid response
            if(!response || response.status !== 200 || response.type !== 'basic') {
              return response;
            }

            // IMPORTANT: Clone the response. A response is a stream
            // and because we want the browser to consume the response
            // as well as the cache consuming the response, we need
            // to clone it so we have two streams.
            var responseToCache = null;

            caches.open(dataCacheName)
              .then(function(cache) {
                event.request.method !== "POST" && cache.put(event.request, responseToCache);
              });

            return response;
          }
        );
      })
    );
});