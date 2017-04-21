/// @description Insert description here
draw_set_font(fnt_8bit);

if(state == "input_name"){
	draw_set_halign(fa_left);
	draw_text(100,200,"Enter your name: " + player_name);
	if(keyboard_check_released(vk_anykey)){
		if(string_length(keyboard_string) <= 10){
			player_name = string_upper(keyboard_string);
		}
		if(keyboard_lastkey == vk_backspace){
			var len = string_length(player_name);
			string_delete(player_name, len, 1);
		}
		if(keyboard_lastkey == vk_enter){
			state = "send_score";
		}
	}
}

if(state == "top_scores"){
	draw_set_halign(fa_center);
	draw_text(500,50,top_scores);
}