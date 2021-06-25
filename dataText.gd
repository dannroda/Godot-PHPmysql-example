extends Node2D
var myurl = "http://localhost:8080/" # Acá va la url donde vaya a estar el script php
var phpCarga = "cargaDatabase.php"
var phpDescarga = "jsonDatabase.php"
var phpCrear = "createDatabase.php"
var dataText = "testData"
var score = 14
var dict = {'name': dataText,'score': score }



# Called when the node enters the scene tree for the first time.
func _ready():
	pass # Replace with function body.


# Called every frame. 'delta' is the elapsed time since the previous frame.
#func _process(delta):
#   pass


func _on_Button_pressed():
	_make_post_request(myurl + phpCrear, dict, false)
	print(myurl + phpCarga)
	print("Datos Enviados")

func _make_post_request(url, data_to_send, use_ssl):
	# Convert data to json string:
	var query = JSON.print(data_to_send)
	# Add 'Content-Type' header:
	var headers = ["Content-Type: application/json"]
	$HTTPRequest.request(url, headers, use_ssl, HTTPClient.METHOD_POST, query)
	
func _on_dButton_pressed():
	$HTTPRequest.request("http://www.mocky.io/v2/5185415ba171ea3a00704eed")
	print(myurl + phpDescarga)
	print("Datos Descargados")	
	
func _on_HTTPRequest_request_completed( result, response_code, headers, body ):
	var json = JSON.parse(body.get_string_from_utf8())
	print(json.result)
