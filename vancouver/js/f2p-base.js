function store() {
    if(searchResults) {
        sessionStorage.clear();
        for(var i=1;i<searchResults.length+1;i++) {
            sessionStorage[i] = searchResults[i];
        }
    }
}

//************************************LOAD SINGLE RESULT CONTAINER *******************************************//
function loadResults(start,end, is_idea_page) {
    if (!sessionStorage) {
        return;
    }

    if (typeof is_idea_page == 'undefined') {
        is_idea_page = 'false';
    }

    var cookies = get_cookies_array();
    for(var name in cookies) {
        if(name == 'f2p-browsing') {
            var iselector = "#"+cookies[name];
        }
    }

    //jQuery("#results").hide();
    for (var i = start; i < end; i++) {
        if (sessionStorage.getItem(i) && sessionStorage.getItem(i) != "undefined") {
            var date1 = sessionStorage.getItem(i);

            if(sessionStorage.getItem(i+1) && sessionStorage.getItem(i+1) != "undefined") {
                var date2 = sessionStorage.getItem(i+1);
                i = i+1;
            } else {
             date2 = "empt";
            }

            if(sessionStorage.getItem(i+1) && sessionStorage.getItem(i+1) != "undefined") {
                var date3 = sessionStorage.getItem(i+1);
                i = i+1;
            } else {
                date3 = "empt";
            }

            if (is_idea_page == true) {
                input_date = "action=loaddateforideapage&dateID1="+date1+"&dateID2="+date2+"&dateID3="+date3;
            } else {
                input_date = "action=loaddate&dateID1="+date1+"&dateID2="+date2+"&dateID3="+date3;
            }

            jQuery.ajax({
                type: "POST",
                url:  "/vancouver/wp-admin/admin-ajax.php",
                data: input_date,
                success: function(msg) {
                    if (is_idea_page == true) {
                        jQuery(".similar_packages").append(msg);
                    } else {
                        jQuery("#results2").append(msg);
                    }
                    if (iselector) {
                        jQuery(iselector).find('.testsearch2').css('display','block');
                    }
                }
            });
        } else {
            jQuery("#ur-date-ideas2").html('<p style="font-size:24px;color:#777;clear:both;">------------------------------ WE ALSO SUGGEST ------------------------------</p>');
            if (is_idea_page == true) {
                input_date = "action=loaddateforideapage&dateID1=rand";
            } else {
                input_date = "action=loaddate&dateID1=rand";
            }

            jQuery.ajax({
                type: "POST",
                url:  "/vancouver/wp-admin/admin-ajax.php",
                data: input_date,
                success: function(msg) {
                    if (is_idea_page == true) {
                        jQuery(".similar_packages").append(msg);
                    } else {
                        jQuery("#results2").append(msg);
                    }
                }
            });
        }
    }

    //jQuery("#results").show();
    searchIndex += end;
}

function get_cookies_array() {
    var cookies = { };

    if (document.cookie && document.cookie != '') {
        var split = document.cookie.split(';');
        for (var i = 0; i < split.length; i++) {
            var name_value = split[i].split("=");
            name_value[0] = name_value[0].replace(/^ /, '');
            cookies[decodeURIComponent(name_value[0])] = decodeURIComponent(name_value[1]);
        }
    }

    return cookies;
}
