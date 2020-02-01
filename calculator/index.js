var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    //... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Submit";
    } else {
        document.getElementById("nextBtn").innerHTML = "Next";
    }
    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n)
}

function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form...
    if (currentTab >= x.length) {
        // ... the form gets submitted:
        document.getElementById("regForm").submit();
        return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
}

function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
            // add an "invalid" class to the field:
            y[i].className += " invalid";
            // and set the current valid status to false
            valid = false;
        }
    }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
}

function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class on the current step:
    x[n].className += " active";
}


$(function () {

    $('.pickup-select2').select2();
    $('.dropoff-select2').select2();


    $("#tabs").tabs();

    var slider = $("#slider, #slider2").slider({
        value: 100,
        min: 0,
        max: 100,
        step: 12.5
    });

    $(".parentElement .childElement").on("click", function () {
        console.log($(slider).value + 1);
    });

    var firstText = $(".parentElement .singleElem:first-child").text();

    $(".ui-tabs-panel .parentElement .singleElem").click(function () {
        var firstChildVal = $(this).html();

        $(".appendActiveTabFirstVal").html(firstChildVal);
        if ($(".home_childElement").slice(0, 3)) {
            $(".track_movers p span:first-child").text('XL');
            $(".track_movers p span:last-child").text('5');
        } else {
            console.log("Nothing!")
        }

    });
});


const home_business_json_data = [
    {
        "itemOne": "A few large items or a large appliance",
        "itemTwo": "Just archive boxes, up to 170"
    },
    {
        "itemOne": "1 bed home Average",
        "itemTwo": "Furnished office 2 people"
    },
    {
        "itemOne": "Small storage unit, up to 10m3",
        "itemTwo": "Heaps of archive boxes, up to 250"
    },
    {
        "itemOne": "2 bed home Average",
        "itemTwo": "Small office Up to 5 people"
    },
    {
        "itemOne": "1 - 2 bed home Lots of stuff!",
        "itemTwo": "Big or tall furniture or shop fittings"
    },
    {
        "itemOne": "Large storage unit, up to 20m3",
        "itemTwo": "Medium office Up to 10 people"
    },
    {
        "itemOne": "3 - 4 bed home Average",
        "itemTwo": "Large office Up to 20 people"
    },
    {
        "itemOne": "Big home Lots of stuff!",
        "itemTwo": "Lots and lots of big stuff!"
    }
] 


  console.log(home_business_json_data);

   // set JSON data to HOME tab lists
  const home_parentElement = document.querySelector('.home_parentElement');
  for( var i = 0; i < home_business_json_data.length; i++){
    home_parentElement.innerHTML += "<div class='lists' data-id=''>" + home_business_json_data[i].itemOne + "</div>";
  }

  // dummy
  var home_child = document.querySelectorAll('.lists');
  home_child.forEach(item => { item.addEventListener('click', event => { console.log(item.innerText) }) })


  // set JSON data to BUSINESS tab lists
  const business_parentElement = document.querySelector('.business_parentElement');
  for( var j = 0; j < home_business_json_data.length; j++){
    business_parentElement.innerHTML += "<div class='lists' data-id=''>" + home_business_json_data[j].itemTwo + "</div>";
  }


  // Get click item data from home/ business tab
  document.querySelectorAll('.lists').forEach(item => {
    item.addEventListener('click', event => {
     var home_data = item.innerText
     console.log(home_data)
    })
  })

   
  // get value from pickup and droplist select item
    document.addEventListener(newFunction(), function(){
        const pickup_select = document.querySelector('.pickup_select');
        pickup_select.addEventListener("change", (event) => {
        const pickup_select_val = pickup_select.options[pickup_select.selectedIndex].text
        // var strUser = e.options[e.selectedIndex].value;
        console.log(pickup_select_val);
            // console.log(event.target.value);
        });

        var pickup_select2 = document.querySelector('.pickup-select2');
        pickup_select2.addEventListener('click', function(){
            var get_value = this.text
        });

        // const pickup_select2 = document.querySelector(getValueFromSelect());
        // function getValueFromSelect('.pickup-select2'){
        //     const pickup_select = document.querySelector('.pickup_select');
        //     pickup_select.addEventListener("change", (event) => {
        //         console.log(pickup_select_val);
        //     })
        // }

    });

    function newFunction() {
        return "DOMContentLoaded";
    }


    $(document).ready(function(){

        $('.pickup-select2').on('change', function(){
            console.log($('.pickup-select2 option:selected').text());
            // console.log($(this).val());
        });

        $('.dropoff-select2').on('change', function(){
            console.log($('.dropoff-select2 option:selected').text());
            // console.log($(this).val());
        })

    });