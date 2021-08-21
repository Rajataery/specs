function ConvertAddress(){
   var value =  document.getElementById("Google-address-autofill").value;


var geocoder = new google.maps.Geocoder();

geocoder.geocode( { 'address': value}, function(results, status) {

  if (status == google.maps.GeocoderStatus.OK) {
    var latitude = results[0].geometry.location.lat();
    var longitude = results[0].geometry.location.lng();
    document.getElementById("latitude").value = latitude;
    document.getElementById("longitude").value = longitude;
  } 
}); 
}