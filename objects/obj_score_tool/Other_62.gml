/// @description Get async results
var r_str = "null";
if (ds_map_find_value(async_load, "id") == post) {
	if(ds_map_find_value(async_load, "status") == 0){
		r_str = ds_map_find_value(async_load, "result");
		show_debug_message(r_str);
    }
	state = "get_score";
	return;
}

if (ds_map_find_value(async_load, "id") == get) {
	if(ds_map_find_value(async_load, "status") == 0){
		r_str = ds_map_find_value(async_load, "result");
		top_scores = r_str;
		state = "top_scores";
	}
	return;
}