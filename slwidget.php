<?php
header("content-Type: text/javascript");
?>/***************************
SL Widget

A widget that shows dynamic data (now mockup) about a location with (mockup) ability
to get a instant travel advice and even booking factuality directly from a web page.

Copyright (C) 2012 Alexander Forselius

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*******************************/
/***
Class for location data
***/
function SLLocation(name, type,route,  endDest) {
	this.type = type; // Trafikslag
	this.name = name; // Namn
	this.route = route; // Linje, röda linjen, buss 54 etc.
	this.endDest = endDest; // Mot slutdestination, som Norsborg etc.
	this.node = document.createElement("li");
	this.node.innerHTML = "" + this.type + ", " + this.route + " mot " + this.endDest + " kliv av vid " + this.name + "";
	
	
}
var widget = document.getElementById("sl-root");

var destination = "<?php echo $_GET['destination']?>";

// Mode to get locationis chosen by either GPS, querystring etc.
var mode = "<?php echo $_GET['mode']?>";
if(mode == "") {
	mode = "GPS"; // Mode gps as default
}

// As this is a mockup, GPS is not provided at this time, and inste
var _location = "";
if(mode == "GPS") {
	_location = "Hornstull"; // I live at hornstull so I do so in the mockup
} else {
	_location = "<?php echo $_GET['location'] ?>";
}
// create new css link
var css_link = document.createElement("link");
css_link.setAttribute("type", "text/css");
css_link.setAttribute("rel", "stylesheet");
css_link.setAttribute("href", "http://static.cobresia.webfactional.com/sl/sl.css");
document.getElementsByTagName("head")[0].appendChild(css_link);


// Eftersom SL inte har något api gör vi en simpel mockup

widget.setAttribute("class", "sl-widget");
widget.innerHTML = "<img src=\"http://sl.se/ui/Images/logo.gif\" width=\"24\" /> Trafikplanerare <hr /><b>" + destination + "</b><br /> Från " + _location + "<br />";

// Create a mockup of some location
var locations = [];
var T_centralen = new SLLocation("T-centralen", "T-bana", "Röda linjen", "Mörby centrum eller Ropsten");
var Medborgarplatsen = new SLLocation("Medborgarplatsen", "T-bana", "Gröna linjen", "Hagsätra, Farsta strand eller Skarpnäck");
locations.push(T_centralen);
locations.push(Medborgarplatsen);

// Append to the ul
var ul = document.createElement("ol");
for(var i = 0; i < locations.length; i++) {
	ul.appendChild(locations[i].node);
}
widget.appendChild(ul);
widget.innerHTML += "<hr /><a href=\"http://www.sl.se\" target=\"_blank\">Visa mer &gt;&gt;</a>";
