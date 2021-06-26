extends Node2D
var myurl = "http://www.saberes-astronomia.uns.edu.ar/testdb/php/" # Acá va la url donde vaya a estar el script php
var phpDescarga = "jsonDatabase.php?tabla="
var phpCrear = "createDatabase.php?tabla="
var tabla = "ct"
var dataText = "testData"
var score = 14




# Called when the node enters the scene tree for the first time.
func _ready():
	pass # Replace with function body.


# Called every frame. 'delta' is the elapsed time since the previous frame.
#func _process(delta):
#   pass


func _on_Button_pressed():
	print(myurl + phpCrear + tabla)
	var cont = $LineEdit.text
	var dict = {'name': dataText,'score': score, 'contenido': cont, 'coso' : 'coso'}
	var dd = {'test' : 'test'}
	var teste = JSON.print(dict)
	var test = JSON.print(dd)
	var k = teste[-1].insert(test)
	print(k)
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
	var i = $LineEdit2.text
	#var j = json.result[0]
	if json.result != null : 
	#	print(j.count)
		print(i)
		print(json.result[str(i)]['contenido'])
		#$RichTextLabel.text = json.result[num]['contenido']


func _on_TextEdit_focus_entered():
	OS.show_virtual_keyboard()
	print("test")
	 # Replace with function body.


func _on_TextEdit_focus_exited():
	OS.hide_virtual_keyboard() # Replace with function body.


func _on_LineEdit_focus_entered():
	OS.show_virtual_keyboard() # Replace with function body.


func _on_LineEdit_focus_exited():
	OS.hide_virtual_keyboard() # Replace with function body.


