var clubList = [];
var restaurantList = [];
var shoppingList = [];
var eventList = [];

$(document).bind('mobileinit', function(){
	eventList = [];
	clubList = [];
	restaurantList = [];
	shoppingList = [];
	
	$.extend($.mobile,{
		defaultPageTransition: 'slide'
	});
});

function getPostCategory(post){
	var cat = {id:-1,name:'',parent:-1};
	post.terms.forEach(function(term){
		if (term.taxonomy == 'category'){
			cat.id = term.term_id;
			cat.name = term.name;
			cat.parent = term.parent;
		}
	});
	return cat;
}

function getSquareThumbnail(original_link){
	var strLink = original_link.substring(0,original_link.lastIndexOf('250x'));
	var strSize = original_link.substring(original_link.lastIndexOf('250x'));
	var arrSize = strSize.split('.');
	arrSize[0] = '150x150';
	strSize = '';
	arrSize.forEach(function(part){
		strSize += (part + '.');
	});
	strSize = strSize.substring(0,strSize.length-1);
	strLink = strLink + strSize;
	return strLink;
}

function getFullSizeImg(original_link){
	var strLink = original_link.substring(0,original_link.lastIndexOf('-250x'));
	var strSize = original_link.substring(original_link.lastIndexOf('-250x'));
	var arrSize = strSize.split('.');
	arrSize[0] = '';
	strSize = '';
	arrSize.forEach(function(part){
		strSize += (part + '.');
	});
	strSize = strSize.substring(0,strSize.length-1);
	strLink = strLink + strSize;
	return strLink;
}

function parseEvent(post){
	var meta = {
		id: post.post_id,
		name: post.post_title,
		post_content:post.post_content,
		address: '',
		direction: '',
		date: '',
		time: '',
		poster_link: '',
		poster_thumbnail_link: '',
		map: ''
	};
	
	post.custom_fields.forEach(function(field){
		if (field.key == 'snbp_event_venue'){
			meta.address = field.value;
		} else if (field.key == 'snbp_event_location'){
			meta.direction = field.value;
		} else if (field.key == 'snbp_event_date'){
			meta.date = field.value;
		} else if (field.key == 'snbp_event_time'){
			meta.time = field.value;
		} else if (field.key == 'snbp_pitemlink'){
			meta.poster_thumbnail_link = getSquareThumbnail(field.value);
			meta.poster_link = getFullSizeImg(field.value);
		} else if (field.key == 'snbp_event_map'){
			meta.map = field.value;
		}
	});
	
	return meta;
}

function external_link(link){
	if (link.indexOf('http://') != 0){
		return 'http://' + link;
	} else {
		return link;
	}
}

function getEventInfo(post_id){
	var event_info = false;
	eventList.forEach(function(post){
		if (post.post_id == post_id){
			event_info = post;
			return;
		}
	});
	return event_info;
}

function showLoading(){
	$.mobile.showPageLoadingMsg("a", "Đang tải dữ liệu... Vui lòng chờ.");
}

function hideLoading(){
	$.mobile.hidePageLoadingMsg();
}

function getUrlVars() {
	var vars = [], hash;
	var hashes;

	if ($.mobile.activePage.data('url').indexOf("?") != -1){ // first check the active page url for parameters
		hashes = $.mobile.activePage.data('url').slice($.mobile.activePage.data('url').indexOf('?') + 1).split('&');
	} else { // otherwise just get the current url
		hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	}

	for(var i = 0; i < hashes.length; i++) {
		hash = hashes[i].split('=');

		if(hash.length > 1 && hash[1].indexOf("#") == -1){ // filter out misinterpreted paramters caused by JQM url naming scheme
			vars[hash[0]] = hash[1];
		}
	}

	return vars;
}