geocode();
function geocode() {
                  var location = "22 Main st Boston MA"
                  axios.get('https://maps.googleapis.com/maps/api/geocode/json', {
                                    params: {
                                                      address: location,
                                                      key: 'AIzaSyBVnVZtGcKOCoSFNRU42OuB4sWBDHvmRM8'
                                    }
                  })
                                    .then(function (response) {
                                                      console.log(response);
                                    })
                                    .catch(function (error) {
                                                      console.log(error);
                                    });

}