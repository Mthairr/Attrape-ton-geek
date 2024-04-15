var SelectAge = document.getElementById("age");

//Create an age list to choose an age between 18 and 120
for (var i=18; i<=120; i++){
    var option= document.createElement("option");
    option.text = i;
    option.value = i;
    SelectAge.add(option);
}