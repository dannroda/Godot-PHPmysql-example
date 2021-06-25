extends Node2D
var myurl = "http://localhost:8080/php/" # Acá va la url donde vaya a estar el script php
var phpDescarga = "jsonDatabase.php?tabla="
var phpCrear = "createDatabase.php?tabla="
var tabla = "ingreso"
var dataText = "testData"
var score = 14
var dict = {'name': dataText,'score': score, 'test': "test" }



# Called when the node enters the scene tree for the first time.
func _ready():
	pass # Replace with function body.


# Called every frame. 'delta' is the elapsed time since the previous frame.
#func _process(delta):
#   pass


func _on_Button_pressed():
	print(myurl + phpCrear + tabla)
	_make_post_request(myurl + phpCrear + tabla, dict, false)
	print("Datos Enviados")

func _make_post_request(url, data_to_send, use_ssl):
	# Convert data to json string:
	var query = JSON.print(data_to_send)
	# Add 'Content-Type' header:
	var headers = ["Content-Type: application/json"]
	$HTTPRequest.request(url, headers, use_ssl, HTTPClient.METHOD_POST, query)
	
func _on_dButton_pressed():
	print(myurl + phpDescarga + tabla)
	$HTTPRequest.request(myurl + phpDescarga + tabla)
	print("Datos Descargados")	
	
func _on_HTTPRequest_request_completed( result, response_code, headers, body ):
	var json = JSON.parse(body.get_string_from_utf8())
	if json.result != null : 
		print(json.result)
