////////Function/////////////////////////////////////////////////////////

function alertInto(icon, text, url) {
    Swal.fire({
        text: text,
        icon: icon,
        confirmButtonText: 'ตกลง',
        confirmButtonColor: '#021b39'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    })
}

function alertUpdate(icon, text, url) {
    Swal.fire({
        position: "top-center",
        icon: icon,
        title: text,
        timer: 1500,
        showConfirmButton: false
    }).then(function () {
        window.location.href = url;
    });
}

function alertConfirm(key, text, url) {
    Swal.fire({
        title: "ยืนยันการ" + key,
        text: text,
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#021b39",
        cancelButtonColor: "#d33",
        confirmButtonText: "ยืนยันการ" + key,
        cancelButtonText: "ยกเลิก"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    })
}

function loginCheck(fnam) {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 1500,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: "success",
        title: "ยินดีต้อนรับ" + " " + fnam
    }).then(function () {
        window.location.href = 'index.php';
    });
}

function regisCheck(fnam) {
    Swal.fire({
        position: "top-center",
        icon: "success",
        title: "ลงทะเบียนเรียบร้อย กำลังเข้าสู่ระบบอัตโนมัติ...",
        timer: 2500,
        showConfirmButton: false
    }).then(function () {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1300,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            title: "ยินดีต้อนรับ" + " " + fnam
        }).then(function () {
            window.location.href = 'index.php';
        });
    });
}

















function test(text) {
    alert(text);
}

////////////For add product/////////////////////
// const btnCart = document.querySelector('#btn_cart');
// btnCart.addEventListener('click', (event) =>{
//     Swal.fire({
//         position: "top-end",
//         icon: "success",
//         title: "Your work has been saved",
//         showConfirmButton: false,
//         timer: 1500
//       });
// })

















function develop() {
    alert("อยู่ในระหว่างพัฒนา");
}


