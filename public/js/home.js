// click to shoose file other
$("#shotcutBtnfile").click(function(){
  removefilePost();
  console.log('choose img file');
  $('#fileall').click();
});
//remove image
function removefilePost() {
  console.log('remove');
  $('#showDetil').text('');
  $('#showImg').hide();
  $('#showVideo').hide();
  $( "#status" ).removeClass( "col-md-9" ).addClass( "col-md-12" );
  $('#fileall').val('');
}
//popup function
function popup_worng(title2) {
  var p = new Popelt({
    title: title2,
    closeButton: false,
    escClose: false,
    modal: true
  });
  p.addButton('OK','btn btn-danger', function(){
    removefilePost();
    p.close();
  });
  p.show();
}
 //show previwe file
var Typefile;
var TypeNamefile;
$(function () {
 $('#fileall').on('change',function(){
    $( "#status" ).removeClass( "col-md-12" ).addClass( "col-md-9" );
    var file = this.files[0],
        fileName = file.name,
        fileType = file.type,
        fileSize = file.size/1024;
   console.log(fileName+' '+fileSize+' '+fileType);
   var res = fileType.split("/");
   Typefile = res[0];
   TypeNamefile = res[1];
   if(Typefile=="image" && (fileSize/1024) > 5){ popup_worng("Limit image file ( 5MB )"); return;}
   if(Typefile=="audio" && (fileSize/1024) > 10){ popup_worng("Limit audio file ( 10MB )"); return;}
   if(Typefile=="video" && (fileSize/1024) > 50){ popup_worng("Limit video ( 150MB )"); return;}
   if(Typefile=="application" && (fileSize/1024) > 25){ popup_worng("Limit file ( 25MB )"); return;}
   console.log('Typefilesss :'+ Typefile);
   var reader = new FileReader();
   reader.onload = viewer.load;
   reader.readAsDataURL(file);
   viewer.setProperties(file);
 });
 var viewer = {
   load : function (e) {
     if(Typefile=="image"){
       $('#Img').attr('src',e.target.result);
     }
     if(Typefile=="video"){
       $('#my-video').attr('src',e.target.result);
     }

   },
   setProperties : function (file) {
     $('#typefile').text(Typefile);
     var nameprototype = file.name;
     if(file.name.length > 25){
      var limittext = file.name.length - 25;
      console.log(limittext);
      nameprototype = file.name.slice(0, -limittext) +'....';
     }
   $('#showDetil').text(nameprototype + '  size ' +Math.round((file.size/1024)) +' Byte');
   $('#typefile').val(Typefile)
   var splitnamefile = file.name.split(".");
   TypeNamefile = splitnamefile[splitnamefile.length-1] ;
     $("#showBox").fadeIn();
     if(Typefile=="image"||Typefile=="video"||Typefile=="audio"||Typefile=="application"){
       if(Typefile=="image"){
         $('#typefile').val(Typefile);
         $("#showImg").fadeIn();
       }
       if(Typefile=="video"){
         if(TypeNamefile == "wmv"){
           popup_worng('**คำเตือน** ไฟล์วิดีโอไม่ถูกต้อง');
         }else{
           $('#Img').attr('src',"public/icon/preview_video.png");
           $("#showImg").fadeIn();
         }
       }
       if(Typefile=="audio"){
         $('#Img').attr('src',"public/icon/preview_audio.png");
         $("#showImg").fadeIn();
       }
       if(Typefile=="application"){
         if(TypeNamefile == "doc" || TypeNamefile == "docx"){
           $('#Img').attr('src',"public/icon/preview_doc.png");
           $("#showImg").fadeIn();
         }else if(TypeNamefile == "ppt" || TypeNamefile == "pptx"){
           $('#Img').attr('src',"public/icon/preview_pp.png");
           $("#showImg").fadeIn();
         }else if(TypeNamefile == "xlsx" || TypeNamefile == "xlsm" || TypeNamefile == "xlsb"){
           $('#Img').attr('src',"public/icon/preview_excel.png");
           $("#showImg").fadeIn();
         }else if(TypeNamefile == "pdf"){
           $('#Img').attr('src',"public/icon/preview_pdf.png");
           $("#showImg").fadeIn();
         }else if(TypeNamefile == "exe"){
           popup_worng('**คำเตือน** ไม่อนุญาติให้อัพไฟล์ .exe');
         }else{
           $('#Img').attr('src',"public/icon/preview_file.png");
           $("#showImg").fadeIn();
         }
       }
     }else{ //ถ้าไม่ใช่ image video audio application
         console.log(TypeNamefile);
         popup_worng('**คำเตือน** กรุณาเลือกเลือกชนิดไฟล์ให้ถูกต้อง');
         console.log(TypeNamefile);
     }
   },
   }
});
//edit post status
function editporttext(id,text) {
  console.log('edit '+id +'text '+text);
  $('#idstatustext').val(id);
  $('#feele_edit').val(text);
  $('#myModal').fadeIn();
}
function editport(id,text,path,type,type2){
  console.log('edit file'+id);
  $('#idstatusfile').val(id);
  $('#feele_edit2').val(text);
    if(type2 == 'image'){
      $('#image_edit').attr('src', path);
      $('#image_edit').fadeIn();
    }
    if(type2 == 'video' ){
      $('#image_edit').attr('src',"public/icon/preview_video.png");
      $("#image_edit").fadeIn();
    }
    if(type2 == 'audio' ){
      $('#image_edit').attr('src',"public/icon/preview_audio.png");
      $("#image_edit").fadeIn();
    }
    if(type2 == 'application' ){
      if(type == "doc" || type == "docx"){
        $('#image_edit').attr('src',"public/icon/preview_doc.png'");
        $('#image_edit').fadeIn();
      }else if(type == "ppt" || type == "pptx"){
        $('#image_edit').attr('src',"public/icon/preview_pp.png");
        $('#image_edit').fadeIn();
      }else if(type == "xlsx" || type == "xlsm" || TypeNamefile == "xlsb"){
        $('#image_edit').attr('src',"public/icon/preview_excel.png");
        $('#image_edit').fadeIn();
      }else if(type == "pdf"){
        $('#image_edit').attr('src',"public/icon/preview_pdf.png");
        $('#image_edit').fadeIn();
      }else{
        $('#image_edit').attr('src',"public/icon/preview_file.png");
        $('#image_edit').fadeIn();
      }
    }
  $('#myModal2').fadeIn();
}
function close_edit(){
  $('#myModal').fadeOut();
  $('#myModal2').fadeOut();
}
function showComment(id){
  $('#showcommet'+id).fadeToggle();
  showdatacomment(id);
  var audio = new Audio('public/tones/all-eyes-on-me.mp3');
  audio.play();
}

function deleteport(id,urld) {
  $('#get_id').val(id)
  $("#"+id+"").fadeOut();
  var url2 = urld; // the script where you handle the form input.
  var data2 = { Id : id};
  $.ajax({
         type: "get",
         url: url2,
         data: data2, // serializes the form's elements.
         success: function(result){
           console.log(result);
           var audio = new Audio("public/tones/your-turn.mp3");
           audio.play();
         },
         error: function(xhr,textStatus){ alert(textStatus);}
       });
}
// i think so
function deleteThinkso(idstatus,urld,user_id) {
  goToByScrolls(idstatus);
  var url2 = urld; // the script where you handle the form input.
  var data2 = { Id : idstatus ,
                Id_user : user_id};
  console.log('deleteThinkso'+idstatus);
  $.ajax({
         type: "get",
         url: url2,
         data: data2, // serializes the form's elements.
         success: function(result){
           console.log(result);
          $('#deleteThinkso'+idstatus).hide();
          $('#saveThinkso'+idstatus).css({"background-color":"#555",
                                           "border":"0px",
                                           "color":"#333",
                                            });
          if(result == '0'){
            $('#saveThinkso'+idstatus).html('I think so.');
          }else{
            $('#saveThinkso'+idstatus).html('I think so. ('+(result)+')');
          }
          $('#saveThinkso'+idstatus).fadeIn();
          var audio = new Audio("public/tones/your-turn.mp3");
          audio.play();
         },
         error: function(xhr,textStatus){ alert(textStatus);}
       });
}
function saveThinkso(idstatus,urls,user_id) {
  goToByScrolls(idstatus);
  console.log(urls);
  var url2 = urls; // the script where you handle the form input.
  var data2 = { Id : idstatus ,
               Id_user : user_id };
  console.log('saveThinkso'+idstatus);
  $.ajax({
         type: "get",
         url: url2,
         data: data2, // serializes the form's elements.
         success: function(result){
           console.log(result);
           $('#saveThinkso'+idstatus).hide();
           $('#deleteThinkso'+idstatus).css({"background-color":"#555",
                                           "border":"0px",
                                           "color":"#fff",
                                            });
          if(result == '0'){
            $('#deleteThinkso'+idstatus).html('I think so.');
          }else{
            $('#deleteThinkso'+idstatus).html('I think so. ('+(result)+')');
          }
          $('#deleteThinkso'+idstatus).fadeIn();
          var audio = new Audio('public/tones/just-like-that.mp3');
          audio.play();
         },
         error: function(xhr,textStatus){ alert(textStatus);}
       });
}

function goToByScrolls(id){
  console.log(id);
  var positionId =  $('#'+id).position();
  console.log(positionId);
  $("#bodyshow").animate({ scrollTop: positionId.top }, 250);
}
