<?php

/**
 * className : RegistrationModel
 * @
 */


class RegistrationModel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    public function getUniversity($search = "")
    {

        $query =

            $this->db->select('university_id as id,SchoolName as text')

            ->from('university');

        if (!empty($search)) {
            $query->group_start();
            $query->like('LOWER(SchoolName)', strtolower($search), 'before');
            $query->group_end();
        }

        $query->order_by('SchoolName', 'ASC');

        $query->limit(20);

        $query = $query->get();

        return $query->result_array();
    }

    public function getFieldList($search = "")
    {
        $query =

            $this->db->select('id,name as text')

            ->from('field_of_study_master');

        if (!empty($search)) {
            $query->group_start();
            $query->like('LOWER(name)', strtolower($search), 'before');
            $query->group_end();
        }

        $query->order_by('name', 'ASC');

        $query->where('status', 1); // all active records.

        $query->limit(20);

        $query = $query->get();

        return $query->result_array();
    }

    public function getMajorList($id, $search = "")
    {


        if (empty($id)) return [];


        $query =

            $this->db->select('id,name as text')

            ->from('major_master')

            ->where('field_id', $id); // all active records.

        if (!empty($search)) {
            $query->group_start();
            $query->like('LOWER(name)', strtolower($search), 'before');
            $query->group_end();
        }

        $query->order_by('name', 'ASC');

        $query->limit(20);

        $query = $query->get();

        return $query->result_array();
    }

    public function getUniversityById($id)
    {
        $query =

            $this->db->select('*')

            ->from('university')

            ->where('university_id', $id)

            ->get();

        return $query->row_array();
    }
}
