$(function() {
  function getAjax(url, success) {
    var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    xhr.open('GET', url);
    xhr.onreadystatechange = function() {
        if (xhr.readyState>3 && xhr.status==200) success(xhr.responseText);
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.send();
    return xhr;
  }


  var INDEX = 0; 
  $("#chat-submit").click(function(e) {
    e.preventDefault();
    var msg = $("#chat-input").val(); 
    if(msg.trim() == 'https://nhom4.herokuapp.com/api/chatBotGet?message=t%C3%B4i%20mu%E1%BB%91n%20mua%20tai%20phone'){
      return false;
    }
    generate_message(msg, 'self');


    getAjax('https://nhom4.herokuapp.com/api/chatBotGet?message='+msg, 
      function(data){ 
        console.log(JSON.parse(data)); 
        console.log(JSON.parse(data).result);  

         var buttons = [
            {
              name: 'Existing User',
              value: 'existing'
            },
            {
              name: 'New User',
              value: 'new'
            }
          ];
          generate_message(JSON.parse(data).result, 'user');  
    });

    
  })
  function generate_message(msg, type) {
    var message = msg;
    var index = message.search("http");
    var msg_href = "";
    var msg_text = "";
    if(index >= 0) {
      msg_href += message.substring(index,message.lenght)
      msg_text += message.substring(0,index);
    };
    INDEX++;
    var str="";
    str += "<div id='cm-msg-"+INDEX+"' class=\"chat-msg "+type+"\">";
    str += "          <span class=\"msg-avatar\">";
    // str += "            <img src=\"\">";
    str += "          <\/span>";
    str += "         <div class=\"cm-msg-text\">";
    if (msg_href != "") {
      str += msg_text;
      str += "<a href='"+msg_href+"' target='_blank'>";
      str += msg_href;
      str += "</a>"
    }else{
      str += msg;
    }
    str += "          <\/div>";
    str += "        <\/div>";
    $(".chat-logs").append(str);
    $("#cm-msg-"+INDEX).hide().fadeIn(300);
    if(type == 'self'){
     $("#chat-input").val(''); 
    }    
    $(".chat-logs").stop().animate({ scrollTop: $(".chat-logs")[0].scrollHeight}, 1000);    
  }  
  

   
  $(document).delegate(".chat-btn", "click", function() {
    var value = $(this).attr("chat-value");
    var name = $(this).html();
    $("#chat-input").attr("disabled", false);
    generate_message(name, 'self');
  })   
 // click
  $("#chat-circle").click(function() {    
    $("#chat-circle").toggle('scale');
    $(".chat-box").toggle('scale');
  })
  // close
  $(".chat-box-toggle").click(function() {
    $("#chat-circle").toggle('scale');
    $(".chat-box").toggle('scale');
  })
  
})