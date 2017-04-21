/// @description State machine
switch(state){
	case "waiting":
		break;
	case "input_name":
		break;
	case "send_score":
		state = "waiting";
		player_score = 99;
		//player_score = random_range(1,50000);
		var s = string_format(player_score, 7, 0);
		var s6 = string_char_at(s, 1);
		var s5 = string_char_at(s, 2);
		var s4 = string_char_at(s, 3);
		var s3 = string_char_at(s, 4);
		var s2 = string_char_at(s, 5);
		var s1 = string_char_at(s, 6);
		var s0 = string_char_at(s, 7);	
		
		var str = "";
		str += s6 == "" ? keys[6,0] : keys[6, int64(s6)];
		str += s5 == "" ? keys[5,0] : keys[5, int64(s5)];
		str += s4 == "" ? keys[4,0] : keys[4, int64(s4)];
		str += s3 == "" ? keys[3,0] : keys[3, int64(s3)];
		str += s2 == "" ? keys[2,0] : keys[2, int64(s2)];
		str += s1 == "" ? keys[1,0] : keys[1, int64(s1)];
		str += s0 == "" ? keys[0,0] : keys[0, int64(s0)];

		post = http_post_string(url_base + "hs_insert.php?Name=" + player_name + "&Game=test&Score=" + string(str),"");
		break;
	case "get_score":
		state = "waiting";
		get = http_get(url_base + "hs_get.php?Game=test&HowMany=20");
		break;
}

if(state = "waiting" and keyboard_check(ord("I"))){
	state = "input_name";
	keyboard_string = "";
}

if(state = "waiting" and keyboard_check(ord("G"))){
	state = "get_score";
}

if(state = "top_scores" and keyboard_check(vk_escape)){
	state = "waiting";
}