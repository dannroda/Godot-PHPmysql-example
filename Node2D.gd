extends Node2D
var myurl = "http://localhost:8080/" # Acá va la url donde vaya a estar el script php
var phpDescarga = "jsonDatabase.php?"
var phpCrear = "createDatabase.php?"
var tabla = "&tabla="
var clave = "&clave="
var dataText = "testData"
var score = 142




# Called when the node enters the scene tree for the first time.
func _ready():
	pass # Replace with function body.


# Called every frame. 'delta' is the elapsed time since the previous frame.
#func _process(delta):
#   pass


func _on_Button_pressed():
	
	var cont = $LineEdit.text
	var codigo = $LineEdit2.text
	
	var dict = {'codigo': codigo, 'name': dataText ,'score': score, 'cont': cont, 'coso' : 'coso'}
	#print(dict)
	var tblname = $LineEdit3.text
	print(myurl + phpCrear + tabla + tblname + clave + codigo)
	_make_post_request(myurl + phpCrear + tabla + tblname + clave + codigo, dict, false)
	print("Datos Enviados")

func _make_post_request(url, data_to_send, use_ssl):
	# Convert data to json string:
	var query = JSON.print(data_to_send)
	#print("query")
	print(query)
	# Add 'Content-Type' header:
	var headers = ["Content-Type: application/json"]
	$HTTPRequest.request(url, headers, use_ssl, HTTPClient.METHOD_POST, query)
	
func _on_dButton_pressed():
	print(myurl + phpDescarga + tabla)
	$HTTPRequest.request(myurl + phpDescarga + tabla + 'user')
	print("Datos Descargados")	
	
func _on_HTTPRequest_request_completed( result, response_code, headers, body ):
	print(body.get_string_from_utf8())
	#var json = JSON.parse(body.get_string_from_utf8())
	#print(body.get_string_from_utf8())
	#print(json)
	#var i = $LineEdit2.text
	#var codigo = json.result[0]
	#$HTTPRequest.request(myurl + phpDescarga + tabla + 'user' + clave + codigo)
	#var j = json.result[0]
#	if json.result != null : 
	#	print(j.count)
		#print(json.result[0]['cont'])
#		print(json.result)
#		$RichTextLabel.text = json.result[0]['cont']


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




func _on_HTTPRequest_request_completed2(result, response_code, headers, body):
	pass # Replace with function body.


func _on_LineEdit3_focus_entered():
	OS.hide_virtual_keyboard()  # Replace with function body.


func _on_LineEdit3_focus_exited():
	OS.hide_virtual_keyboard()  # Replace with function body.
