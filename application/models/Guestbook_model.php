<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Guestbook_model extends CI_Model
	{
		
		public function __construct()
		{
			parent::__construct();
		}

// Данная функция получает все комментарии из БД (вместе с ответами)

		public function getAllComments()
		{
			$data = $this->query_getAll('comments');
			$data = $this->getAllAnswerComments($data);
			return $data;
		}

// Данная функция записывает комментарии прибывшие POST-запросом в таблицу comments (предварительно подготавливая их с помощью preparationData)
		public function addComments($data)
		{
			$data = $this->preparationData($data, true);
			return $this->query_add('comments', $data);
		}

// Данная функция записывает ответы на комментарии прибывшие POST-запросом в таблицу commentsAnswer (предварительно подготавливая их с помощью preparationData)
		public function addAnswerComment($data)
		{
			$data = $this->preparationData($data, true);
			return $this->query_add('commentsAnswer', $data);
		}

// Данная функция изменяет записи в таблице commments на основании данных прибывших POST-запросом (предварительно подготавливая их с помощь preparationData)
		public function editComments($data)
		{
			$data = $this->preparationData($data, false);
			return $this->query_edit('comments', $data);
		}

// Данная функция отправляет запрос в базу данных на получение всех данных из таблицы переданной в $tablename с лимитом ($limit) и условием ($where)
		private function query_getAll($tablename, $limit = '', $where = '') 
		{
			$query = $this->db->get($tablename, $limit, $where);
			return $query->result_array();
		}

// Данная функция формирует запрос на добавление данных в таблицу и выполняет его. Функции передаются два параметра: название таблицы и массив данных
		private function query_add($tablename, $data)
		{
			$query = $this->db->insert_string($tablename, $data);
			return $this->db->query($query);
		}

		private function query_edit($tablename, $data, $id)
		{

		}

// Данная функция "склеивает" массивы комментариев и ответов на комментарии
		private function getAllAnswerComments($data)
		{
			$answerComments = $this->query_getAll('commentsAnswer');
			$i = 0;
			foreach ($data as $item) {
				$comments[$i] = $item;
				foreach ($answerComments as $key => $answerItem) {
					if($comments[$i]['id'] === $answerItem['idComment']){
						$comments[$i]['answerComments'] = $answerItem;
					} else {
						continue;
					}
				}
				$i++;
			}
			return $comments;
		}

		// Данная функция подготавливает массив данных к отправке в БД ()
		// Второй парамметр говорит о том, подготавливаются ли данные для добавления или редактирования (true - добавление, false - редактирование)
		private function preparationData($data, $isAdd = true)
		{
			if($isAdd)
			{
				// Проверяем данные
				if($this->protectedData($data)){
					// Добавляем ID комментария с помощь addNewIdComments, так как использование AI MySQL не целесообразно
					$data['id'] = $this->addNewIdComments();
					// Добавляем ID сесси в массив
					$data['sessionId'] = session_id();
					// Добавляем текущее время и дату в массив
					$data['date'] = $this->getRussianDate(date('d M Y \в H:i:s', time()));
					return $data;
				}
			} else {
				// Проверяем данные
				if($this->protectedData($data)){
					// Удаление пустых элементов из массива
					$data = $this->emptyElementsFromArray($data);
					// Разделяем массив на еще два массива (в первом будет лежать id редактируеммой записи, а во втором данные)
					
					// Сверяем ID записи, которую мы редактируем и ID записи присланной из формы
					// Можно добавить обновление времени публикации (так как редактируется тут строго по сессии в поле "дата редактирование" отпадает нужда)
					return $data;
				}
			}
		}

// Данная функция вычисляет новый ID на основании последнего использованного ID
		private function addNewIdComments()
		{
			$lastId = $this->getLastId();
			$lastId += 1;
			return $lastId;
		}

// Данная функция получает последний использованный ID и возвращает его в виде строки
		private function getLastId()
		{
			$query = $this->db->query('SELECT id FROM comments ORDER BY id DESC LIMIT 1');
			$lastId = $query->result_array();
			$lastId = $lastId['0']['id'];
			return $lastId;
		}

		// Данная функция должна будет проверять данные (пока не реализованно)
		private function protectedData($data)
		{
			return true;
		}

		// Данная функция удаляет все пустые элементы массива

		private function emptyElementsFromArray($array)
		{
			foreach ($array as $key => $value) {
				if($value == ''):
					unset($array[$key]);
				endif;
			}
			return $array;
		}

		// Функция "руссификации" даты
		private function getRussianDate($date)
		{
			$reg = '#(Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sept|Oct|Nov|Dec)#';
			preg_match($reg, $date, $result);
			switch ($result[0]) {
				case 'Jan':
					$date = preg_replace('#'.$result[0].'#', 'Янв', $date);
					break;
				case 'Feb':
					$date = preg_replace('#'.$result[0].'#', 'Фев', $date);
					break;
				case 'Mar':
					$date = preg_replace('#'.$result[0].'#', 'Марта', $date);
					break;
				case 'Apr':
					$date = preg_replace('#'.$result[0].'#', 'Апр', $date);
					break;
				case 'May':
					$date = preg_replace('#'.$result[0].'#', 'Мая', $date);
					break;
				case 'Jun':
					$date = preg_replace('#'.$result[0].'#', 'Июня', $date);
					break;
				case 'Jul':
					$date = preg_replace('#'.$result[0].'#', 'Июля', $date);
					break;
				case 'Aug':
					$date = preg_replace('#'.$result[0].'#', 'Авг', $date);
					break;
				case 'Sept':
					$date = preg_replace('#'.$result[0].'#', 'Сент', $date);
					break;
				case 'Oct':
					$date = preg_replace('#'.$result[0].'#', 'Окт', $date);
					break;
				case 'Nov':
					$date = preg_replace('#'.$result[0].'#', 'Ноя', $date);
					break;
				case 'Dec':
					$date = preg_replace('#'.$result[0].'#', 'Дек', $date);
					break;
				default:
					return false;	
					break;
			}
			return $date;
		}

	}

?>