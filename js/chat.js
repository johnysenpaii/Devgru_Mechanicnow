const form = document.querySelector(".typing-area"),
custID = form.querySelector(".custID").value, //incoming id for mechanic
inputField = form.querySelector(".input-field1"),
sendBtn = form.querySelector(".btn1"),
chatBox = document.querySelector(".chatBox");
// userInf = document.querySelector(".user-inf"),//for the header
// passUser = document.querySelector(".passUser"),
// passBtn = passUser.querySelector(".passBtn");

form.onsubmit = (e)=>{
    e.preventDefault();
}

inputField.focus();
inputField.onkeyup = ()=>{
    if(inputField.value != ""){
        sendBtn.classList.add("active");
    }else{
        sendBtn.classList.remove("active");
    }
}

sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../mechanicPages/mechInsertchat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              inputField.value = "";
              scrollToBottom();
          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}
chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../mechanicPages/mechGetchat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            chatBox.innerHTML = data;
            if(!chatBox.classList.contains("active")){
                scrollToBottom();
              }
          }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("custID="+custID);
}, 500);

//passuser
// passBtn.onclick = ()=>{
//     let xhr = new XMLHttpRequest();
//     xhr.open("POST", "../mechanicPages/mechDispvo.php", true);
//     xhr.onload = ()=>{
//       if(xhr.readyState === XMLHttpRequest.DONE){
//           if(xhr.status === 200){
//               let data = xhr.response;
//               userInf.innerHTML = data;
//           }
//       }
//     }
//     let formData = new FormData(passUser);
//     xhr.send(formData);
// }

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
  }