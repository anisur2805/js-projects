geocode();
function geocode() {
  var location = "22 Main st Boston MA";
  axios
    .get("https://maps.googleapis.com/maps/api/geocode/json", {
      params: {
        address: location,
        key: "AIzaSyBO59mo6rMe4ChzmBqEQgz9QmWjg_X38c"
      }
    })
    .then(function(response) {
      console.log(response);
    })
    .catch(function(error) {
      console.log(error);
    });
}


https://youtu.be/pRiQeo17u6c?list=PLillGF-RfqbbnEGy3ROiLWk7JMCuSyQtX&t=682