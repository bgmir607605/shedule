<?php
  require_once 'Classes/PHPExcel.php'; // Подключаем библиотеку PHPExcel
  $phpexcel = new PHPExcel(); // Создаём объект PHPExcel
  /* Каждый раз делаем активной 1-ю страницу и получаем её, потом записываем в неё данные */
  $page = $phpexcel->setActiveSheetIndex(0); // Делаем активной первую страницу и получаем её
  $page->setCellValue("A1", "Hello"); // Добавляем в ячейку A1 слово "Hello"
  $page->setCellValue("A2", "World!"); // Добавляем в ячейку A2 слово "World!"
  $page->setCellValue("B1", "MyRusakov.ru"); // Добавляем в ячейку B1 слово "MyRusakov.ru"
  $page->setTitle("Test"); // Ставим заголовок "Test" на странице
  /* Начинаем готовиться к записи информации в xlsx-файл */
  $objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
  /* Записываем в файл */
  $objWriter->save("test.xlsx");
?>