$(document).ready(function() {
    $('#searchForm').on('submit', function(e) {
        e.preventDefault();
        var command = $('#queryInput').val().trim();
        var parsedCommand = command.split(" ");
        var action = parsedCommand[0];
        var tableName = parsedCommand[1];
        var id = parsedCommand[2] || '';

        $('#formContainer').empty();
        $('#result').empty();

        switch (action) {
            case 'create':
                displayCreateTableForm(tableName);
                break;
            case 'read':
                if (id === 'all') {
                    fetchAndDisplayAll(tableName);
                } else {
                    fetchAndDisplayRow(tableName, id);
                }
                break;
            case 'update':
                fetchAndDisplayUpdateForm(tableName, id);
                break;
            case 'delete':
                confirmAndDisplayRow(tableName, id);
                break;
            default:
                $('#result').html('<p>Comando no reconocido</p>');
                break;
        }
    });
});

function displayCreateTableForm(tableName) {
    let formHtml = `
        <h2>Crear nueva tabla: ${tableName}</h2>
        <div id="columnsContainer">
            <div class="columnRow">
                <input type="text" class="columnName" placeholder="Nombre de columna" required />
                <select class="dataType">
                    <option value="VARCHAR(255)">Texto</option>
                    <option value="INTEGER">Entero</option>
                    <option value="FLOAT">Decimal</option>
                    <option value="DATE">Fecha</option>
                </select>
            </div>
        </div>
        <button type="button" id="addColumn">Añadir Columna</button>
        <button type="button" id="createTable">Crear Tabla</button>
    `;
    $('#formContainer').html(formHtml);

    $('#addColumn').click(function() {
        $('#columnsContainer').append(`
            <div class="columnRow">
                <input type="text" class="columnName" placeholder="Nombre de columna" required />
                <select class="dataType">
                    <option value="VARCHAR(255)">Texto</option>
                    <option value="INTEGER">Entero</option>
                    <option value="FLOAT">Decimal</option>
                    <option value="DATE">Fecha</option>
                </select>
            </div>
        `);
    });

    $('#createTable').click(function() {
        let columns = [];
        $('.columnRow').each(function() {
            let columnName = $(this).find('.columnName').val();
            let dataType = $(this).find('.dataType').val();
            columns.push({ name: columnName, type: dataType });
        });
        createTable(tableName, columns);
    });
}

function createTable(tableName, columns) {
    let isValid = columns.every(col => /^[a-zA-Z_][a-zA-Z0-9_]*$/.test(col.name));
    if (!isValid) {
        $('#result').html('<p>Error: Los nombres de las columnas deben comenzar con una letra o un guion bajo y solo pueden contener letras, números y guiones bajos.</p>');
        return;
    }

    let columnDefinitions = columns.map(col => `${col.name} ${col.type}`).join(', ');
    $.ajax({
        url: 'IntelForm.php',
        type: 'POST',
        data: {
            action: 'create',
            tableName: tableName,
            columnDefinitions: columnDefinitions
        },
        success: function(response) {
            $('#result').html(response);
        },
        error: function(xhr, status, error) {
            console.error('Error en la solicitud AJAX:', error);
            $('#result').html('<p>Ocurrió un error al crear la tabla.</p>');
        }
    });
}

function fetchAndDisplayAll(tableName) {
    $.ajax({
        url: 'IntelForm.php',
        type: 'POST',
        data: {
            action: 'readAll',
            tableName: tableName
        },
        success: function(response) {
            let data = JSON.parse(response);
            let html = '<table><tr>';
            if (data.length > 0) {
                Object.keys(data[0]).forEach(key => {
                    html += `<th>${key}</th>`;
                });
                html += '</tr>';
                data.forEach(row => {
                    html += '<tr>';
                    Object.values(row).forEach(value => {
                        html += `<td>${value}</td>`;
                    });
                    html += '</tr>';
                });
            } else {
                html += '<tr><td colspan="100%">No se encontraron datos.</td></tr>';
            }
            html += '</table>';
            $('#result').html(html);
        },
        error: function(xhr, status, error) {
            console.error('Error en la solicitud AJAX:', error);
            $('#result').html('<p>Ocurrió un error al leer los datos.</p>');
        }
    });
}

function fetchAndDisplayRow(tableName, id) {
    $.ajax({
        url: 'IntelForm.php',
        type: 'POST',
        data: {
            action: 'read',
            tableName: tableName,
            id: id
        },
        success: function(response) {
            let data = JSON.parse(response);
            let html = '<table><tr>';
            if (data) {
                Object.keys(data).forEach(key => {
                    html += `<th>${key}</th>`;
                });
                html += '</tr><tr>';
                Object.values(data).forEach(value => {
                    html += `<td>${value}</td>`;
                });
                html += '</tr>';
            } else {
                html += '<tr><td colspan="100%">No se encontró el registro.</td></tr>';
            }
            html += '</table>';
            $('#result').html(html);
        },
        error: function(xhr, status, error) {
            console.error('Error en la solicitud AJAX:', error);
            $('#result').html('<p>Ocurrió un error al leer los datos.</p>');
        }
    });
}

function fetchAndDisplayUpdateForm(tableName, id) {
    $.ajax({
        url: 'IntelForm.php',
        type: 'POST',
        data: {
            action: 'read',
            tableName: tableName,
            id: id
        },
        success: function(response) {
            let data = JSON.parse(response);
            if (data) {
                let formHtml = `<h2>Actualizar fila en la tabla: ${tableName}</h2>`;
                Object.keys(data).forEach(key => {
                    formHtml += `<div>
                                    <label>${key}</label>
                                    <input type="text" class="updateValue" data-key="${key}" value="${data[key]}" />
                                 </div>`;
                });
                formHtml += `<button type="button" onclick="updateRow('${tableName}', '${id}')">Actualizar</button>`;
                $('#formContainer').html(formHtml);
            } else {
                $('#result').html('<p>No se encontró el registro.</p>');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error en la solicitud AJAX:', error);
            $('#result').html('<p>Ocurrió un error al obtener el formulario de actualización.</p>');
        }
    });
}

function updateRow(tableName, id) {
    let updateData = {};
    $('.updateValue').each(function() {
        let key = $(this).data('key');
        let value = $(this).val();
        updateData[key] = value;
    });

    $.ajax({
        url: 'IntelForm.php',
        type: 'POST',
        data: {
            action: 'update',
            tableName: tableName,
            id: id,
            updateData: JSON.stringify(updateData)
        },
        success: function(response) {
            $('#result').html(response);
        },
        error: function(xhr, status, error) {
            console.error('Error en la solicitud AJAX:', error);
            $('#result').html('<p>Ocurrió un error al actualizar el registro.</p>');
        }
    });
}

function confirmAndDisplayRow(tableName, id) {
    $.ajax({
        url: 'IntelForm.php',
        type: 'POST',
        data: {
            action: 'read',
            tableName: tableName,
            id: id
        },
        success: function(response) {
            let data = JSON.parse(response);
            let html = '<table><tr>';
            if (data) {
                Object.keys(data).forEach(key => {
                    html += `<th>${key}</th>`;
                });
                html += '</tr><tr>';
                Object.values(data).forEach(value => {
                    html += `<td>${value}</td>`;
                });
                html += `</tr></table><button onclick="deleteRow('${tableName}', '${id}')">Eliminar Registro</button>`;
            } else {
                html = '<tr><td colspan="100%">No se encontró el registro.</td></tr>';
            }
            $('#result').html(html);
        },
        error: function(xhr, status, error) {
            console.error('Error en la solicitud AJAX:', error);
            $('#result').html('<p>Ocurrió un error al leer los datos.</p>');
        }
    });
}

function deleteRow(tableName, id) {
    $.ajax({
        url: 'IntelForm.php',
        type: 'POST',
        data: {
            action: 'delete',
            tableName: tableName,
            id: id
        },
        success: function(response) {
            $('#result').html(response);
        },
        error: function(xhr, status, error) {
            console.error('Error en la solicitud AJAX:', error);
            $('#result').html('<p>Ocurrió un error al eliminar el registro.</p>');
        }
    });
}