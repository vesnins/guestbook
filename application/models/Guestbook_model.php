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

// Данная функция записывает комментарии прибывшие POST-запросом в таблицу comments (предварительно подготавливая их с помощью preparationData) и возвращает строку вида созданную функцией getViewNewComment()
		public function addComments($data)
		{
			$data = $this->preparationData($data, true);
			$this->query_add('comments', $data);
			return $this->getViewNewComment($data);
		}

// Данная функция записывает ответы на комментарии прибывшие POST-запросом в таблицу commentsAnswer (предварительно подготавливая их с помощью preparationData) и возвращает строку вида созданную функцией getViewNewAnswerComment()
		public function addAnswerComment($data)
		{
			$data = $this->preparationData($data, true);
			$this->query_add('commentsAnswer', $data);
			return $this->getViewNewAnswerComment($data);
		}

// Данная функция изменяет записи в таблице comments на основании данных прибывших POST-запросом (предварительно подготавливая их с помощь preparationData)
		public function editComments($data)
		{
			$data = $this->preparationData($data, false, 'comment');
			return $this->query_edit('comments', $data['data'], $data['id']);
		}

// Данная функция изменяет записи в таблице commentsAnswer на основании данных прибывших POST-запросом (предварительно подготавливая их с помощь preparationData)
		public function editAnswerComment($data)
		{
			$data = $this->preparationData($data, false, 'answer');
			return $this->query_edit('commentsAnswer', $data['data'], $data['id']);
		}

// Данная функция удаляет запись в таблице comments на основании id переданного POST-запросом (предварительно проверив есть ли такой id в таблице)
		public function deleteComment($id)
		{
			if($this->checkId('comments', $id)){
				return $this->query_delete('comments', $id);
			} else {
				return false;
			}
		}

// Данная функция удаляет запись в таблице commentsAnswer на основании id переданного POST-запросом (предварительно проверив есть ли такой id в таблице)
		public function deleteAnswerComment($data)
		{
			if($this->checkId('commentsAnswer', $id)){
				return $this->query_delete('commentsAnswer', $id);
			} else {
				return false;
			}
		}

// Данная функция отправляет запрос в базу данных на получение всех данных из таблицы переданной в $tablename с лимитом ($limit) и условием ($where)
		private function query_getAll($tablename, $limit = '', $ofset = '') 
		{
			$query = $this->db->get($tablename, $limit, $ofset);
			return $query->result_array();
		}

// Данная функция формирует запрос на добавление данных в таблицу и выполняет его. Функции передаются два параметра: название таблицы и массив данных
		private function query_add($tablename, $data)
		{
			$query = $this->db->insert_string($tablename, $data);
			return $this->db->query($query);
		}

// Данная функция формирует запрос на обновление данных в таблицу и выполняет его. Функции передаются три парамметра: название таблицы, массив данных и id по которому она "понимает" какую запись обновлять
		private function query_edit($tablename, $data, $id)
		{
			$query = $this->db->update_string($tablename, $data, 'id = '.$id);
			return $this->db->query($query);
		}

// Данная функция формирует запрос на удаление данных в таблицу и выполняет его. Функции передается 2 параметра: ID удаляемой записи и таблица в которой его надо будет удалять
		private function query_delete($tablename, $id)
		{
			$query = $this->db->delete($tablename, array('id' => $id));
			return $query;
		}
// Данная функция "склеивает" массивы комментариев и ответов на комментарии
		private function getAllAnswerComments($data)
		{
			$this->getAnswerComments();
			$i = 0;
			foreach ($data as $commentsItem) {
				$comments[$i] = $commentsItem;
				$j = 0;
				/*foreach ($answerComments as $answerItem) {
					if($commentsItem['id'] === $answerItem['idComment'])
					{
						$comments[$i]['answerComments'][$j] = $answerItem;
						$j++;
					}
					foreach ($answerComments as $answersItem) {
						if($answerItem['id'] === $answersItem['idComment'])
						{
							$comments[$i]['answerComments'][$j] = $answersItem;
							$j++;
						}
					}*/
				

				$i++;
			}
		//	print_r($comments);
		//	return $comments;			
		}

		private function getAnswerComments()
		{
			$i = 0;
			$answerComments = $this->query_getAll('commentsAnswer');
			foreach ($answerComments as $answerItem) {

				$answersComments = $this->db->get_where('commentsAnswer', array('id' => $answerItem['idComment']));
				print_r($answerComments);
				echo $answerItem['idComment']." = ".$answersComments[15]['id'];
				echo "<br/><br/><hr/><hr/>";
				$answer[$i]['answerComments'] = $answersComments->result_array();
				echo "<br/>".print_r($answer[$i]['answerComments'])."<br/>";
				echo "<hr/>";
				$i++;
			}
			
		}

		// Данная функция подготавливает массив данных к отправке в БД ()
		// Второй парамметр говорит о том, подготавливаются ли данные для добавления или редактирования (true - добавление, false - редактирование)
		// Третий парамметр говорит о том, с каким видом комментарие мы работаем ('comment' или 'answer') актуально для блока редактирования
		private function preparationData($data, $isAdd = true, $type = '')
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
					// Получаем ID записи по дате
					$commentId = $this->getIdForDate($data, $type);
					// Разделяем массив на еще два массива (в первом будет лежать id редактируеммой записи, а во втором данные)
					$data = array('id' => $commentId, 'data' => $data);
					// Сверяем ID записи, которую мы редактируем и ID записи присланной из формы
					// Можно добавить обновление времени публикации (так как редактируется тут строго по сессии в поле "дата редактирование" отпадает нужда)
					$data['data']['date'] = $this->getRussianDate(date('d M Y \в H:i:s', time()));
					return $data;
				}
			}
		}

// Данная функция вычисляет новый ID на основании последнего использованного ID
		private function addNewIdComments()
		{
			@$lastId = $this->getLastId();
			$lastId += 1;
			return $lastId;
		}

// Данная функция получает последний использованный ID и возвращает его в виде строки
		private function getLastId()
		{
			$queryCom = $this->db->query('SELECT id FROM comments ORDER BY id DESC LIMIT 1');
			$queryComAns = $this->db->query('SELECT id FROM commentsAnswer ORDER BY id DESC LIMIT 1');
			$com = $queryCom->result_array();
			$comAns = $queryComAns->result_array();
			if($com['0']['id'] < $comAns['0']['id']) {
				$lastId = $comAns['0']['id'];
			} else {
				$lastId = $com['0']['id'];
			}
			@$lastId = $lastId;
			return $lastId;
		}

		// Данная функция должна будет проверять данные (пока не реализованно)
		private function protectedData($data)
		{
			return true;
		}

		// Данная функция проверяет переданный id с id находящимся в таблице БД (принимает 2 параметра: сам id и название таблицы в которой будет происходить проверка)
		private function checkId($tablename, $id)
		{
			$this->db->select('id');
			$id_db = $this->db->get_where($tablename, array('id' => $id), 1);
			$id_db = $id_db->result_array();
			if($id == $id_db[0]['id'])
			{
				return true;
			} else {
				return false;
			}
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

// Данная функция вычисляет ID записи по дате. Функции передаются два параметра: массив данных и тип комментария ('comment' или 'answer')
		private function getIdForDate($data, $type)
		{
			if($type === 'comment') {
				$this->db->select('id');
				$id = $this->db->get_where('comments', array('date' => $data['date']), 1);
				$id = $id->result_array();
				return $id[0]['id'];				
			} elseif($type === 'answer') {
				$this->db->select('id');
				$id = $this->db->get_where('commentsAnswer', array('date' => $date['date']), 1);
				$id = $id->result_array();
				return $id[0]['id'];
			}
		}

// Данная функция возвращает отрендеренный ответ на комментарий для Ajax
		private function getViewNewAnswerComment($data)
		{
			// Получаем из базы данных firstname комментария на который отвечали
			$this->db->select('firstname');
			$firstnamePreComment = $this->db->get_where('comments', array('id' => $data['idComment']), 1);
			$firstnamePreComment = $firstnamePreComment->result_array();
			// Если в таблице комментариев нет искомого id смотрим в таблицу ответов
			if (@$firstnamePreComment[0]['firstname'])
			{
				$data['preCommentFirstName'] = $firstnamePreComment[0]['firstname'];
			} else {
				$firstnamePreComment = $this->db->get_where('commentsAnswer', array('id' => $data['idComment']), 1);
				$firstnamePreComment = $firstnamePreComment->result_array();
				$data['preCommentFirstName'] = $firstnamePreComment[0]['firstname'];
			}
			return $this->load->view('guestbook/answerComment', $data);
		}

// Данная функция возвращает отрендеренный последний добавленный комментарий для ajax
		private function getViewNewComment($data)
		{
			return $this->load->view('guestbook/comment', $data);
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