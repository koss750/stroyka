let rowCount = 1;
let scatHTML = "<td align='center'><input id='skLength35' class='modal-task' style='width: 100%;' type='text'></td><td align='center'><input id='skWidth35' class='modal-task' style='width: 100%;' type='text'></td>";
let roomHTML = "<td><select id='typeBase' class='modal-test' style='width: 100%;'><option value='df_room_0' selected='true' disabled='disabled'>Тип не выбран</option><option value='df_room_1'>Крыльцо</option><option value='df_room_2'>Терраса</option><option value='df_room_3'>Закрытая терраса</option><option value='df_room_4'>Навес</option><option value='df_room_5'>Гараж</option><option value='df_room_6'>Тамбур</option>	<option value='df_room_7'>Холл</option>	<option value='df_room_8'>Прихожая</option>	<option value='df_room_9'>Прачечная</option>	<option value='df_room_10'>С/У</option>	<option value='df_room_11'>Кухня</option>	<option value='df_room_12'>Кухня-гостиная</option>	<option value='df_room_13'>Гостиная</option>	<option value='df_room_14'>Котельная</option>	<option value='df_room_15'>Гардероб</option>	<option value='df_room_16'>Кабинет</option>	<option value='df_room_17'>Спальня</option>	<option value='df_room_18'>Комната</option>	<option value='df_room_19'>Гараж</option>	<option value='df_room_20'>Кладовая</option>	<option value='df_room_21'>Парная</option>	<option value='df_room_22'>Помывочная</option>	<option value='df_room_23'>Комната отдыха</option>	<option value='df_room_24'>Балкон</option>	<option value='df_room_25'>Антресоль</option>	<option value='df_room_26'>Второй свет</option>	<option value='df_room_27'>Помещение</option>	<option value='df_room_28'>Чердачное помещение</option>	<option value='df_room_29'>Хозблок</option>	<option value='df_room_32'>Коридор</option>	<option value='df_room_33'>Кухня-столовая</option>	<option value='df_room_34'>Столовая</option></select></td><td align='center'><input id='squareBase' class='modal-task' style='width: 100%;' type='text' placeholder=''><div style='display: none;' id='locationBase'>|</div></td><td align='center'><input id='widthBase' class='modal-task' style='width: 100%;' type='text' placeholder=''></td><td align='center'><input id='lengthBase' class='modal-task' style='width: 100%;' type='text' placeholder=''></td>";
function addInputRow(table) {
  rowCount++;

  const newRow = $("<tbody>");
  const inputCell = $("<tr>").html(roomHTML);
  newRow.append(inputCell);

  $("#"+table).append(newRow);
}

function addSkat(table) {
  rowCount++;

  const newRow = $("<tbody>");
  const inputCell = $("<tr>").html(scatHTML);
  newRow.append(inputCell);

  $("#"+table).append(newRow);
}

const up = "up";
const down = "down";

function moveRow(rowId, direction, design) {
  const row = document.querySelector(`tr[data-row-id="${rowId}"]`);
  const targetRow = rowId;
  let targetRowOrder = rowId;
  let rowOrder = rowId
  const designId = design;

  if (targetRow) {

    if (direction === 'up' && rowId>1) {
      rowOrder = rowId-1;
    }
    if (direction === 'down') {
      rowOrder = rowId+1;
    }

    // Send the AJAX request to update the order values
    const url = `api/designs/${designId}/update-order`;
    console.log("here");
    // Perform the AJAX request
     // Create a new XMLHttpRequest object
    const xhr = new XMLHttpRequest();

    // Set up the request
    xhr.open('POST', `/designs/${designId}/update-order`, true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    // Define the request payload
    const data = JSON.stringify({
      row_order: rowOrder,
      target_row_order: targetRowOrder,
    });

    // Set up event listeners for success and error handling
    xhr.onload = function () {
      if (xhr.status >= 200 && xhr.status < 400) {
        // Handle the success response if needed
        console.log(xhr.responseText);
      } else {
        // Handle the error response if needed
        console.error(xhr.statusText);
      }
    };

    xhr.onerror = function () {
      // Handle the error response if needed
      console.error('Request failed');
    };

    // Send the request
    xhr.send(data);
  }
}

(function () {
  // Get the Up/Down buttons and attach click event listeners
  const buttons = document.querySelectorAll('.design-images button');

  buttons.forEach((button) => {
    button.addEventListener('click', handleButtonClick);
  });

  // Event handler for Up/Down button click
  function handleButtonClick(event) {
    const button = event.target;
    const row = button.closest('tr');
    const table = row.closest('table');
    const tbody = table.querySelector('tbody');
    const images = Array.from(tbody.querySelectorAll('tr'));

    const currentIndex = images.findIndex((image) => image === row);
    const newIndex =
      button.textContent === 'Up' ? currentIndex - 1 : currentIndex + 1;

    if (newIndex < 0 || newIndex >= images.length) {
      return;
    }

    // Swap the rows in the table
    tbody.removeChild(row);
    tbody.insertBefore(row, images[newIndex]);

    // Update the order numbers
    images.forEach((image, index) => {
      const orderCell = image.querySelector('.order-cell');
      orderCell.textContent = index + 1;
    });
  }
})();
