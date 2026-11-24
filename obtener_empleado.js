function obtener_empleado($codigo){
	$this->db->where('target', $codigo);
	$query = $this->db->get('employee');
	
	return $query->row_array();
}