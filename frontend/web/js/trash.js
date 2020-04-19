$(function () {
   $.ajaxSetup({
      headers: {'Authorization': 'Basic dGVzdDoxMjEyMTI='},
   });

   $.ajax({
      url: "http://api.test.local/v1/address/create",
      type: "POST",
      data: {
         zip: "666666",
         street: 'ул.Новая'
      },
      success: (data) => console.log(data),
   });
});