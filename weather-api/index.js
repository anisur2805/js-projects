jQuery(document).ready(function($) {
  $.getJSON(
    "http://api.openweathermap.org/data/2.5/weather?q=Dhaka&APPID=c1bae019b78bf19b36567b2469505170",
    function(data) {
      var icon =
        "http://openweathermap.org/img/w/" + data.weather[0].icon + ".png";
      var weather = data.weather[0].main;
      var temp = Math.floor(data.main.temp);
      var sys = data.name;
      console.log(temp);
      console.log(data);

      $(".icon").attr("src", icon);
      $(".weather").append(weather);
      $(".temp").append(temp + ", " + sys);
    }
  );
});