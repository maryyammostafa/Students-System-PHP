$("form.search").submit(function (e) {
    e.preventDefault();
    let data = new FormData(this);
    $.ajax({
        url: "backend/search.php",
        type: "POST",
        data: data,
        success: function (response) {
            console.log(response);
            showStudents(response.students);
            updatePagination(response.total,1);
        },
        error: function (error) {
            Swal.fire({
                icon: "error",
                title: "ERROR!!",
                text: error['responseJSON']['message'],
            });
        }
    });
});

function showStudents(students) {
    $("tbody").html("");
    let tbody = "";
    for (let i = 0; i < students.length; i++) {
        tbody += `
            <tr data-id='${students[i]['id']}'>
                <th>${students[i]['id']}</th>
                <td>${students[i]['first_name']} ${students[i]['last_name']}</td>
                <td>${students[i]['email']}</td>
                <td>${students[i]['password'].slice(0, 15)}...</td>
                <td>${students[i]['age']}</td>
                <td>${students[i]['phone']}</td>
                <td>
                    <a href='edit.php?studentId=${students[i]['id']}' class='btn btn-info text-light me-2 edit'>Edit</a>
                    <button class='btn btn-primary me-2 undo d-none'>Undo</button>
                    <button class='btn btn-danger delete' onclick='deleteStudent(${students[i]['id']})'>Delete</button>
                </td>
            </tr>`;
    }

    $("tbody").html(tbody);
}

function updatePagination(total,currPage) {
    $(".pagination").html("");
    let li = "",
        number = Math.ceil(total/10);
    for (let i = 0; i <= number+1; i++) {
        if(i==0){
            let isDisabled = (currPage == 1) ? 'disabled' : '',
                previous = (currPage == 1) ? 1 : currPage-1;
            li += `<li class='page-item'><a class='page-link ${isDisabled}' href='index.php?page=${previous}'>Previous</a></li>`;
        }else if(i==number+1){
            let isDisabled = (currPage == number) ? 'disabled' : '',
                next = (currPage == number) ? number : currPage+1;
            li += `<li class='page-item'><a class='page-link ${isDisabled}' href='index.php?page=${next}'>Next</a></li>`;
        }else{
            let isActive = (i == currPage) ? 'active' : '';
            li += `<li class='page-item'><a class='page-link ${isActive}' href='index.php?page=${i}'>${i}</a></li>`;
        }
    }

    $(".pagination").html(li);
}

function deleteStudent(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            let data = {studentId : id};
            $.ajax({
                url: "backend/delete.php",
                type: "POST",
                data: data,
                dataType: "json",
                success: function (response) {
                    $(`tr[data-id='${id}']`).remove();
                    Swal.fire({
                        title: "Deleted!",
                        text: "Student has been deleted.",
                        icon: "success"
                    });
                },
                error: function (error) {
                    console.log(error);
                    Swal.fire({
                        icon: "error",
                        title: "ERROR!!",
                        text: error['responseJSON']['message'],
                    });
                }
            });
        }
    });
}