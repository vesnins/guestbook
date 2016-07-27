<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Guestbook_model extends CI_Model
	{
		
		public function __construct()
		{
			parent::__construct();
		}

		public function getAllComments()
		{
			$data = $this->query_getAll('comments');
			$data = $this->getAllAnswerComments($data);
		}


// Данная функция отправляет запрос в базу данных на получение всех данных из таблицы переданной в $tablename с лимитом ($limit) и условием ($where)
		private function query_getAll($tablename, $limit = '', $where = '') 
		{
			$query = $this->db->get($tablename, $limit, $where);
			return $query->result_array();
		}

// Данная функция "склеивает" массивы комментариев и ответов на комментарии
		private function getAllAnswerComments($data)
		{
			$answerComments = $this->query_getAll('commentsAnswer');
			foreach ($data as $item) {
				$i = 0;
				foreach ($answerComments as $key => $answerItem) {
					$comments[$i] = $item;
					if($item['id'] === $answerItem['idComment']){
						$comments[$i]['answerComments'] = $answerItem;
					} else {
						continue;
					}
					$i++;
				}
			}
		}

	}

?>