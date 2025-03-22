<template>
  <div class="PrMap">
    <div id="map" ref="mapContainer"></div>
    <div class="PrMap-controls">
      <button class="PrMap-controls__item PrMap-controls__in" @click="zoomIn">
        <svg width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M4 12H20M12 4V20" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </button>
      <button class="PrMap-controls__item PrMap-controls__out" @click="zoomOut">
        <svg width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M6 12L18 12" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </button>
    </div>
  </div>
</template>

<script setup>
import mapboxgl from "mapbox-gl";

const mapContainer = ref(null);
let map;

const center = ref([1.88, 48.39]);
const zoom = ref(2);
const maxBounds = [[-180, -85], [180, 85]];

const geojsonData = ref({
  type: "FeatureCollection",
  "features": [
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          37.104665,
          55.699204
        ]
      },
      "properties": {
        "description": "Uspenskoe",
        "link": "https://kerimovarchitects.com/en/projects/uspenskoe/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          37.09917150739926,
          55.69915572978054
        ]
      },
      "properties": {
        "description": "Introspective House",
        "link": "https://kerimovarchitects.com/en/projects/introspective-house/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          29.860635,
          60.167703
        ]
      },
      "properties": {
        "description": "Cozy House",
        "link": "https://kerimovarchitects.com/en/projects/small-cozy-house/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          -8.690728,
          37.114390
        ]
      },
      "properties": {
        "description": "Hidden House",
        "link": "https://kerimovarchitects.com/en/projects/lagos/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          36.781968,
          56.703601
        ]
      },
      "properties": {
        "description": "River House",
        "link": "https://kerimovarchitects.com/en/projects/lagos/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          37.367507,
          55.685283
        ]
      },
      "properties": {
        "description": "Luminous Houses",
        "link": "https://kerimovarchitects.com/en/projects/luminous-houses/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          37.173406,
          55.723848
        ]
      },
      "properties": {
        "description": "Okolitsa House",
        "link": "https://kerimovarchitects.com/en/projects/okolitsa-house/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          23.882380,
          56.985563
        ]
      },
      "properties": {
        "description": "Rivue",
        "link": "https://kerimovarchitects.com/en/projects/vikingu-jurmala-latvia/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          -59.906731,
          -34.916434
        ]
      },
      "properties": {
        "description": "Argentina Cultural Center",
        "link": "https://kerimovarchitects.com/en/projects/argentina-cultural-center/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          -8.466902,
          37.104389
        ]
      },
      "properties": {
        "description": "Carvoeiro, Portugal",
        "link": "https://kerimovarchitects.com/en/projects/portimao-portugal/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          37.000409,
          55.717381
        ]
      },
      "properties": {
        "description": "Islavskoe",
        "link": "https://kerimovarchitects.com/en/projects/islavskoe-rublevskoe/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          29.869288,
          60.181775
        ]
      },
      "properties": {
        "description": "Weightless interior",
        "link": "https://kerimovarchitects.com/en/projects/repino/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          23.882984,
          56.983392
        ]
      },
      "properties": {
        "description": "Vikingu Village",
        "link": "https://kerimovarchitects.com/en/projects/vikingu/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          -7.934957,
          37.016557
        ]
      },
      "properties": {
        "description": "Cliff House",
        "link": "https://kerimovarchitects.com/en/projects/cliff-house/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          13.404132,
          52.520634
        ]
      },
      "properties": {
        "description": "Keinwand",
        "link": "https://kerimovarchitects.com/en/projects/keinwand/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          39.732867,
          43.603264
        ]
      },
      "properties": {
        "description": "Sochi",
        "link": "https://kerimovarchitects.com/en/projects/sochi/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          55.257700,
          25.218361
        ]
      },
      "properties": {
        "description": "Palm Villa",
        "link": "https://kerimovarchitects.com/en/projects/dubai/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          37.449328,
          55.784619
        ]
      },
      "properties": {
        "description": "Silver Pine",
        "link": "https://kerimovarchitects.com/en/projects/silver-pine/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          37.238446,
          55.738188
        ]
      },
      "properties": {
        "description": "Okolitsa",
        "link": "https://kerimovarchitects.com/en/projects/okolitsa/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          37.535757,
          55.727489
        ]
      },
      "properties": {
        "description": "Vorobiev Dom",
        "link": "https://kerimovarchitects.com/en/projects/vorobiev-dom/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          -4.887995,
          36.510372
        ]
      },
      "properties": {
        "description": "Marbella",
        "link": "https://kerimovarchitects.com/en/projects/marbella/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          37.039563,
          55.733088
        ]
      },
      "properties": {
        "description": "Swan",
        "link": "https://kerimovarchitects.com/en/projects/swan/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          36.723132,
          55.843431
        ]
      },
      "properties": {
        "description": "Novaya Riga",
        "link": "https://kerimovarchitects.com/en/projects/new-riga/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          37.62460647116467,
          55.7840499430986,
        ]
      },
      "properties": {
        "description": "Geberit",
        "link": "https://kerimovarchitects.com/en/projects/geberit/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          37.711944,
          55.800043
        ]
      },
      "properties": {
        "description": "Nasledie",
        "link": "https://kerimovarchitects.com/en/projects/nasledie/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          37.573015,
          55.725192
        ]
      },
      "properties": {
        "description": "Sadovie Kvartaly",
        "link": "https://kerimovarchitects.com/en/projects/sadovie-kvartaly/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          37.676385,
          55.742793
        ]
      },
      "properties": {
        "description": "Rogozhsky Val",
        "link": "https://kerimovarchitects.com/en/projects/rogozhsky-val/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          37.263881,
          55.560207
        ]
      },
      "properties": {
        "description": "Promenad",
        "link": "https://kerimovarchitects.com/en/projects/promenad/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          37.195451,
          55.540400
        ]
      },
      "properties": {
        "description": "Podmoskownie Vechera",
        "link": "https://kerimovarchitects.com/en/projects/podmoskownie-vechera/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          37.076950525140724,
          55.70688904449894
        ]
      },
      "properties": {
        "description": "Arbor 15",
        "link": "https://kerimovarchitects.com/en/projects/arbor-15/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          37.535593126988026,
          55.75156669323897
        ]
      },
      "properties": {
        "description": "Neva Towers",
        "link": "https://kerimovarchitects.com/en/projects/neva-tower/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          36.674931,
          55.456385
        ]
      },
      "properties": {
        "description": "Inevka",
        "link": "https://kerimovarchitects.com/en/projects/inevka/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          37.624431,
          55.754410
        ]
      },
      "properties": {
        "description": "Flatris",
        "link": "https://kerimovarchitects.com/en/projects/flatris/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          37.138559,
          55.580651
        ]
      },
      "properties": {
        "description": "Active House",
        "link": "https://kerimovarchitects.com/en/projects/active-house/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          16.376209,
          48.207193
        ]
      },
      "properties": {
        "description": "Endless Forest",
        "link": "https://kerimovarchitects.com/en/projects/endless-forest/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          24.811474,
          35.305829
        ]
      },
      "properties": {
        "description": "I.B.E School in Crete",
        "link": "https://kerimovarchitects.com/en/projects/i-b-e-school-in-crete/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          37.602118,
          55.929122
        ]
      },
      "properties": {
        "description": "Anex",
        "link": "https://kerimovarchitects.com/en/projects/anex/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          -99.55864834232933,
          19.203289303189
        ]
      },
      "properties": {
        "description": "Chapultepec Cultural Center",
        "link": "https://kerimovarchitects.com/en/projects/chapultepec-cultural-center/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          37.513985,
          55.714870
        ]
      },
      "properties": {
        "description": "Mosfilm",
        "link": "https://kerimovarchitects.com/en/projects/mosfilm/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          37.47622437742808,
          55.654703538393704
        ]
      },
      "properties": {
        "description": "Korona Air",
        "link": "https://kerimovarchitects.com/en/projects/crown/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          4.357003,
          52.011846
        ]
      },
      "properties": {
        "description": "TU Delft",
        "link": "https://kerimovarchitects.com/en/projects/tu-delft/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          37.458692,
          55.587075
        ]
      },
      "properties": {
        "description": "Mini Park",
        "link": "https://kerimovarchitects.com/en/projects/mini-park/",
      }
    },
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [
          37.676687,
          55.795278
        ]
      },
      "properties": {
        "description": "Sokolniki Park",
        "link": "https://kerimovarchitects.com/en/projects/sokolniki-park/",
      }
    },
  ]
})

const createMap = () => {
  map = new mapboxgl.Map({
    accessToken: "pk.eyJ1IjoiYXJjaHNoYW0xIiwiYSI6ImNseXE5YWlzbjAzOGEybHIzNmR1b2VuN3cifQ.GkZYJnIe3NX8z0WFF04row",
    container: mapContainer.value,
    style: 'mapbox://styles/mapbox/satellite-v9',
    center: center.value,
    zoom: zoom.value,
    hash: false,
  });

  map.on('load', () => {
    map.setMaxBounds(maxBounds);
    map.addSource('places', {
      type: 'geojson',
      data: geojsonData.value,
    });

    geojsonData.value.features.forEach(feature => {
      const el = document.createElement('div');
      el.className = 'custom-marker';
      el.style.backgroundColor = 'white';
      el.style.width = '20px';
      el.style.height = '20px';
      el.style.borderRadius = '50%';
      el.style.border = '1px solid black';
      el.style.cursor = 'pointer';

      const popup = new mapboxgl.Popup({ offset: 25 }).setHTML(
        `<a href="${feature.properties.link}" target="_blank">${feature.properties.description}</a>`
      );
      new mapboxgl.Marker(el).setLngLat(feature.geometry.coordinates).setPopup(popup).addTo(map);
    });
  });
};

const zoomIn = () => {
  map.zoomIn();
};

const zoomOut = () => {
  map.zoomOut();
};

onMounted(() => {
  createMap();
});

onBeforeUnmount(() => {
  if (map) {
    map.remove();
  }
});
</script>

<style>
.PrMap {
  position: relative;
}

#map {
  height: 600px;
  width: 100%;
}

.mapboxgl-marker:hover {
  transition: 0.3s;
  border: 1px solid #fff;
  background-color: #000 !important;
}

.mapboxgl-popup {
  top: 10px !important;
  transition: 0s !important;
}

.mapboxgl-popup-close-button {
  display: none !important;
}

.mapboxgl-popup-content {
  font-family: "Montserrat", Arial, Helvetica, sans-serif !important;
  font-weight: 400;
  padding: 10px 30px !important;
  border-radius: 10px !important;
}

.PrMap-controls {
  margin: auto;
  position: absolute;
  left: 0;
  bottom: 30px;
  right: 0;
  width: 120px;
  height: 50px;
  display: flex;
  gap: 10px;
}

.PrMap-controls__item {
  background-color: rgba(242, 242, 242, 0.65);
  width: 50px;
  height: 50px;
  border-radius: 50%;
}

.PrMap-controls__item svg {
  height: 30px;
  width: 30px;
}

.PrMap-controls__out svg {
  width: 40px;
  height: 35px;
}
</style>
