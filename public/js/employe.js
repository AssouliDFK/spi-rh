
$(document).ready(function () {
    let employeesData = []; // Store employee data
    let isAscending = true; // To track the sorting order
    // Event listener for sorting by name when the header is clicked
    $('#nameHeader').click(function () {
        sortDataByName();
    });
    // Function to populate the table with data
    function populateTable(data) {
        const tableBody = $('tbody');
        tableBody.html('');

        data.forEach(function (row) {
            const newRow =
                '<tr>' +
                '<td>' + row.name + '</td>' +
                '<td>' + row.email + '</td>' +
                '<td>' + row.companyName + '</td>' +
                '<td><a href="' + row.details_url + '" class="btn btn-sm btn-primary">View More Details</a></td>' +
                '<td>' + row.status + '</td>' +
                '</tr>';

            tableBody.append(newRow);
        });

        $('#total_records').html(data.length);
    }

    // Function to sort the data by name
    function sortDataByName() {
        employeesData.sort(function (a, b) {
            const comparison = a.name.localeCompare(b.name);
            return isAscending ? comparison : -comparison; // Toggle sorting order
        });
        populateTable(employeesData);
        isAscending = !isAscending; // Toggle sorting order for the next click
    }

    // Function to fetch employees data
    function fetchEmployeesData(query = '') {
        $.ajax({
            url: actionRoute,
            method: 'GET',
            data: {
                query: query
            },
            dataType: 'json',
            success: function (data) {
                employeesData = data.data;

                if (data.total_rows > 0) {
                    populateTable(employeesData);
                } else {
                    // Handle the case where there is no data
                    const noDataRow =
                        '<tr>' +
                        '<td> No Data </td>' +
                        '<td> No Data </td>' +
                        '<td> No Data </td>' +
                        '<td>' +
                        '<a class="btn btn-sm btn-disabled">No Details</a>' +
                        '</td>' +
                        '<td> No Data </td>' +
                        '</tr>';
                    $('tbody').html(noDataRow);
                    $('#total_records').html(data.total_rows);
                }
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    }

    // Initial population of the table
    fetchEmployeesData();

    // Event listener for searching
    $('#search').keyup(function () {
        const query = $(this).val();
        fetchEmployeesData(query);
    });
});
