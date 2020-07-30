<div id="body"> 
  <div id="chat-circle" class="btn btn-raised">
    <div id="chat-overlay"></div>
    <i class="fab fa-facebook-messenger"></i>
  </div>
  <div class="chat-box">
    <div class="chat-box-header">
      Tư vấn trực tuyến
      <span class="chat-box-toggle"><i class="material-icons">close</i></span>
    </div>
    
      <!-- <div class="chat-box-overlay">   
      </div> -->
      <div class="chat-logs">
      </div><!--chat-log -->
    
    <div class="chat-input">      
      <form id="chat-bot-demo">
        <input type="text" id="chat-input" placeholder="Send a message..."/>
        <button type="text"  class="chat-submit" id="chat-submit"><i class="material-icons">send</i></button>
      </form>      
    </div>
  </div>
</div>

<script>
  // function getAjax(url, success) {
  //   var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
  //   xhr.open('GET', url);
  //   xhr.onreadystatechange = function() {
  //       if (xhr.readyState>3 && xhr.status==200) success(xhr.responseText);
  //   };
  //   xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  //   xhr.send();
  //   return xhr;
  // }



  // function chat(){
  //   var inputValue = document.getElementById("chat-input").value;
  //   getAjax('https://nhom4.herokuapp.com/api/chatBotGet?message='+inputValue, 
  //     function(data){ 
  //       console.log(JSON.parse(data)); 
  //       console.log(JSON.parse(data).result); 
  //       // $('#chat-bot-demo').html(JSON.parse(data).result);
  //   });
  // }
</script>