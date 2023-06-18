let rowCount = 1;

let scatHTML = "<td align='center'><input id='skLength35' class='modal-task' style='width: 100%;' type='text' placeholder='6500'></td><td align='center'><input id='skWidth35' class='modal-task' style='width: 100%;' type='text' placeholder='3400'></td>";
let roomHTML = "<select id='typeBase' class='modal-test' style='width: 100%;'><option value='df_room_0' selected='true' disabled='disabled'>Тип не выбран</option><option value='df_room_1'>Крыльцо</option><option value='df_room_2'>Терраса</option><option value='df_room_3'>Закрытая терраса</option><option value='df_room_4'>Навес</option><option value='df_room_5'>Гараж</option><option value='df_room_6'>Тамбур</option>	<option value='df_room_7'>Холл</option>	<option value='df_room_8'>Прихожая</option>	<option value='df_room_9'>Прачечная</option>	<option value='df_room_10'>С/У</option>	<option value='df_room_11'>Кухня</option>	<option value='df_room_12'>Кухня-гостиная</option>	<option value='df_room_13'>Гостиная</option>	<option value='df_room_14'>Котельная</option>	<option value='df_room_15'>Гардероб</option>	<option value='df_room_16'>Кабинет</option>	<option value='df_room_17'>Спальня</option>	<option value='df_room_18'>Комната</option>	<option value='df_room_19'>Гараж</option>	<option value='df_room_20'>Кладовая</option>	<option value='df_room_21'>Парная</option>	<option value='df_room_22'>Помывочная</option>	<option value='df_room_23'>Комната отдыха</option>	<option value='df_room_24'>Балкон</option>	<option value='df_room_25'>Антресоль</option>	<option value='df_room_26'>Второй свет</option>	<option value='df_room_27'>Помещение</option>	<option value='df_room_28'>Чердачное помещение</option>	<option value='df_room_29'>Хозблок</option>	<option value='df_room_32'>Коридор</option>	<option value='df_room_33'>Кухня-столовая</option>	<option value='df_room_34'>Столовая</option></select></td><td align='center'><input id='squareBase' class='modal-task' style='width: 100%;' type='text' placeholder=''><div style='display: none;' id='locationBase'>|</div></td><td align='center'><input id='widthBase' class='modal-task' style='width: 100%;' type='text' placeholder=''></td><td align='center'><input id='lengthBase' class='modal-task' style='width: 100%;' type='text' placeholder=''>";
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


// Call the function when the button is clicked
$("#addRowButton").click(() => {
  addInputRow();
});