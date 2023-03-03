const element = document.getElementById('date-field');
    setInterval(function () {
        var MyDate = new Date();
var MyDateString = new Date();
MyDate.setDate(MyDate.getDate()+10);

        element.innerText = ('0' + MyDate.getDate()).slice(-2) + '.'
        + ('0' + (MyDate.getMonth()+1)).slice(-2) + '.'
        + MyDate.getFullYear();
      }, 1000);