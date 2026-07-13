    var  pfoto,textoPop,popup,selectControl, selectedFeature;
    // variables obtenidas de la API de panoramio
    var color,upload_date, id, photo_id,longitude, latitude,pheight,pwidth,nombre_estacion,owner_url,owner_id,photo_file_url,photo_url;
    var vectorPano,panoramio_style;
    
    var lat= -33.48;
    var lon= -70.99;
    var zoom= 7;
    var direccion;
var map, layer, gml;
   function llenarDIV(estacion,latitud,longitud,dir){
      var obj = document.getElementById('galeriaP');
texto='';

       /// Aqui podemos enviarle alguna variable a nuestro script PHP
    var variable_post="Mi texto recargado";
       /// Invocamos a nuestro script PHP
    $.post(dir+"estaciones/index", { estacion: estacion, latitud:latitud, longitud: longitud }, function(data){
       /// Ponemos la respuesta de nuestro script en el DIV recargado
    $("#galeriaP").html(data);});
 var lonLat = new OpenLayers.LonLat(longitud, latitud).transform(new OpenLayers.Projection("EPSG:4326"), map.getProjectionObject());
map.panTo(lonLat);

//onClick: function(evt) {  
//                map.panTo(latitud longitud);
//            }  



   } 

        function osm_getTileURL(bounds) {
            var res = this.map.getResolution();
            var x = Math.round((bounds.left - this.maxExtent.left) / (res * this.tileSize.w));
            var y = Math.round((this.maxExtent.top - bounds.top) / (res * this.tileSize.h));
            var z = this.map.getZoom();
            var limit = Math.pow(2, z);
 
            if (y < 0 || y >= limit) {
                return OpenLayers.Util.getImagesLocation() + "404.png";
            } else {
                x = ((x % limit) + limit) % limit;
                return this.url + z + "/" + x + "/" + y + "." + this.type;
            }
        }
        function clear_data() {
            gml.destroyFeatures();
        }
        function check_zoom() { 
return true;
            var zoom = map.getZoom();
		alert(zoom);
            if (zoom >= 11) {  }
            if (zoom >= 9) { return confirm("Loading this amount of data may slow your browser. Are you sure you want to do this?"); }
            $("status").innerHTML = "Area too large. Zoom in to load data. (Current zoom level: "+ zoom + ". Must be at zoom 9+.)";
            return false;
        }  
        function new_data() {
	
            if (!check_zoom()) {  return; }
            clear_data();
            gml.loaded = false;
            gml.url = "http://www.openstreetmap.org/api/0.5/map?bbox=" + map.getExtent().toBBOX();
            $("status").innerHTML = "Loading more data...";
            gml.loadGML();
        }
function iniciar_mapas(dir){
 direccion=dir;
            var options = {
                projection: new OpenLayers.Projection("EPSG:900913"),
                displayProjection: new OpenLayers.Projection("EPSG:4326"),
                units: "m",
                maxResolution: 156543.0339,
                maxExtent: new OpenLayers.Bounds(-20037508.34, -20037508.34,
                                                 20037508.34, 20037508.34),
		controls: [ new OpenLayers.Control.Navigation(), new OpenLayers.Control.PanZoomBar(),new OpenLayers.Control.MousePosition(),new OpenLayers.Control.LayerSwitcher(), new OpenLayers.Control.Attribution() ]
            };
    map = new OpenLayers.Map('map',options);




 
     osm = new OpenLayers.Layer.OSM( "Mapa");
               var mapnik = new OpenLayers.Layer.TMS(
                "OpenStreetMap (Mapnik)",
                "http://tile.openstreetmap.org/",
                {
                    type: 'png', getURL: osm_getTileURL,
                    displayOutsideMaxExtent: true,
                    attribution: '<a href="http://www.openstreetmap.org/">OpenStreetMap</a>'

                }
            );

         //   layer1 = new OpenLayers.Layer.WMS( "OpenLayers WMS",
           //         "http://labs.metacarta.com/wms/vmap0",
             //       {layers: 'basic'} );
            //var gmap = new OpenLayers.Layer.Google("Google", {sphericalMercator:true});

 



     //      var ghyb = new OpenLayers.Layer.Google(
      //         "Google Hybrid",                {type: G_HYBRID_MAP, 'sphericalMercator': true}
      //     );


      /*          var layer2 = new OpenLayers.Layer.Vector("Polygon", {
                    strategies: [new OpenLayers.Strategy.Fixed()],
                    protocol: new OpenLayers.Protocol.HTTP({
                        url: "http://localhost/~yoyi/innova_versionado/web/js/chile.osm",   //<-- relative or absolute URL to your .osm file
                        format: new OpenLayers.Format.OSM()
                    }),
                    projection: new OpenLayers.Projection("EPSG:4326")
                });
 */


map.addLayers([osm])

     // Realizar projeccion del punto del centro 
     var lonLat = new OpenLayers.LonLat(lon, lat).transform(new OpenLayers.Projection("EPSG:4326"), map.getProjectionObject());
     map.setCenter (lonLat, zoom);
 
     // Obtener extensiones. Ojo salen en mercator. hay k proyectar a 4326
     var proj = new OpenLayers.Projection("EPSG:4326");
     var ext = map.getExtent().transform( map.getProjectionObject(), proj);
     var minx = ext.left;
     var miny = ext.bottom;
     var maxx = ext.right;
     var maxy = ext.top;
     //alert (minx + " " + miny + " " + maxx + " " + maxy);
	
     // Cargar el JSON de panoramio
    // OpenLayers.ProxyHost= "/cgi-bin/proxy.cgi?url=";
     url = dir + "estaciones/ListadoEstacionesJSON";
     parametros = {}   
    OpenLayers.loadURL(url, parametros, this, mostrarfotos);	




     
}
 
function mostrarfotos(response) {
   var json = new OpenLayers.Format.JSON();
   

   
   var panoramio = json.read(response.responseText);
   
 //var panoramio = json.read(asa);
   // var panoramio =  eval('(' + response.responseText + ')');
    //Contamos el nÂº de fotos que hay en la caja
 

   var features = new Array(panoramio.length);
    
 
    for (var i = 0; i < panoramio.length; i++)
    {
	upload_date = panoramio[i].upload_date;//"15 January 2007"
	id = panoramio[i].identificador;//"ThoiryK"
	photo_id = panoramio[i].photo_id;//444265
	longitude = panoramio[i].longitud;//-82.350453000000002
	latitude = panoramio[i].latitud;//23.136354000000001
	pheight = panoramio[i].height;//75
    color = panoramio[i].color;
	pwidth = panoramio[i].width;//100
	nombre_estacion = panoramio[i].nombre_estacion;//"Cafe, Calle and Capitol of Cuba"
	owner_url = panoramio[i].owner_url;//"http://www.panoramio.com/user/57893"
	owner_id = panoramio[i].owner_id;//57893
	photo_file_url = panoramio[i].photo_file_url;//"http://mw2.google.com/mw-panoramio/photos/thumbnail/444265.jpg"
	photo_url = panoramio[i].photo_url;//"http://www.panoramio.com/photo/444265"
 
	// fotos para div galeria
	//OpenLayers.Util.getElement('galeria').innerHTML += "<img src='"+photo_file_url+"' alt='' />&nbsp;";

 



	//alert(latitude +" , "+ longitude);
	// Defino un punto
        var fpoint = new OpenLayers.Geometry.Point(longitude,latitude);
	// proyecto de 4326 a proyecciÃ³n mercator
	var proj = new OpenLayers.Projection("EPSG:4326");
	fpoint.transform(proj, map.getProjectionObject() );
 
        // atributos
	var atributos = {
		'upload_date' : upload_date,
		'id': id,
        'color': color,
		'photo_id':photo_id,
		'longitude':longitude,
		'latitude':latitude,
		'pheight':pheight,
		'pwidth':pwidth,
		'pheight':pheight,
		'nombre_estacion':nombre_estacion,
		'owner_url':owner_url,
		'owner_id':owner_id,
		'photo_file_url':photo_file_url,	
		'photo_url':photo_url			 
	 }
		 
	 features[i] = new OpenLayers.Feature.Vector(fpoint,atributos , panoramio_style);
    } // fin del bucle
addLayerPano(features);
}
 
function addLayerPano(features) {
    // estilo punto
    var panoramio_style = new OpenLayers.StyleMap(OpenLayers.Util.applyDefaults(
        { 
          fillOpacity: 1,
  pointRadius: 11,
   fillColor: "${color}",
   fillOpacity: 1,
   strokeColor: "black",
    label: "${id}",
    fontColor: "black",
    fillText: 1,
    //externalGraphic: "${photo_file_url}",

          
  	  //externalGraphic: "panoramio-marker.png"
        },
        OpenLayers.Feature.Vector.style["default"]));
    var vectorPano = new OpenLayers.Layer.Vector("Estaciones Meteorol&oacute;gicas", {styleMap: panoramio_style});
    vectorPano.addFeatures(features);
    map.addLayer(vectorPano);
   
    // add control para evento
	selectControl = new OpenLayers.Control.SelectFeature(vectorPano,
    {onSelect: onFeatureSelect});
	map.addControl(selectControl);
	selectControl.activate();
}   
   
// popups
  function onPopupClose(evt) {
      selectControl.unselect(selectedFeature);
  }
  function onFeatureSelect(feature) {
      selectedFeature = feature;
  

llenarDIV(selectedFeature.attributes.id,selectedFeature.attributes.latitude,selectedFeature.attributes.longitude,direccion);
  }
  function onFeatureUnselect(feature) {
      map.removePopup(feature.popup);
      feature.popup.destroy();
      feature.popup = null;
  }    
