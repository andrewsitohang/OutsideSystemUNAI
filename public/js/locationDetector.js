let latitude = null;
let longitude = null;

const success = (position) => {
    latitude = position.coords.latitude;
    longitude = position.coords.longitude;
    document.querySelector("#latitude").value = latitude;
    document.querySelector("#longitude").value = longitude;

    initMap();
}

const error = () => {
    const alamatDomisili = document.getElementById('alamatDomisili');
    const fotoTempatTinggal = document.getElementById('fotoTempatTinggal');
    const simpanPermohonan = document.getElementById('simpanPermohonan');
    const gpsPenjamin = document.getElementById('gpsPenjamin');
    const notAllowed = document.getElementById('notAllowed');

    alamatDomisili.disabled = true;
    fotoTempatTinggal.disabled = true;
    simpanPermohonan.disabled = true;
    gpsPenjamin.hidden = true;
    notAllowed.classList.remove('d-none');
}

const showLoading = () => {
  document.querySelector('.loading').style.display = 'block';
}

const hideLoading = () => {
  document.querySelector('.loading').style.display = 'none';
}

showLoading();

navigator.geolocation.getCurrentPosition((position) => {
  success(position);
  hideLoading();
}, error);

async function initMap() {
  if (latitude === null || longitude === null) {
      return;
  }
  
  let myLatLng = { lat: latitude, lng: longitude };

  let map = new google.maps.Map(document.getElementById('googleMap'), {
    zoom: 14,
    center: myLatLng
  });

  let marker = new google.maps.Marker({
    position: myLatLng,
    map: map,
    title: 'Lokasi saya'
  });
}
