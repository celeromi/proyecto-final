<?php

   class Consulta extends Controller{

        function __construct(){
            parent::__construct();
            $this->view->alumnos = [];
        }

        function render(){
            $alumnos = $this->model->get();
            $this->view->alumnos = $alumnos;
            $this->view->render('consulta/index');
        }

        function verAlumno($param = null){
            #var_dump($param);
            $idAlumno = $param[0];
            $alumno = $this->model->getByID($idAlumno);

            session_start();
            $_SESSION['id_verAlumno'] = $alumno->matricula;
            $this->view->alumno = $alumno;
            $this->view->mensaje = "";
            $this->view->render('consulta/detalle');
        }

        function actualizarAlumno(){
            session_start();
            // en vez de tomar el dato del formulario lo tomo de la sesion para mas seguridad
            $matricula = $_SESSION['id_verAlumno'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];

            unset($_SESSION['id_verAlumno']);

            if($this->model->update(['matricula' => $matricula, 'nombre' => $nombre, 'apellido' => $apellido])){
                //actualizar alumno exitoso
                $alumno = new Alumno();
                $alumno->matricula = $matricula;
                $alumno->nombre = $nombre;
                $alumno->apellido = $apellido;
                $this->view->alumno = $alumno;
                $this->view->mensaje = "Alumno actualizado correctamente";
            }else{
                $this->view->mensaje = "No se ha actualizado correctamente";
            }
            $this->view->render('consulta/detalle');
        }

        function eliminarAlumno($param = null){
            $matricula = $param[0];

            if($this->model->delete($matricula)){
                $this->view->mensaje = "Alumno eliminado correctamente";
            }else{
                $this->view->mensaje = "No se ha eliminado correctamente";
            }
            $this->render();
        }

   } 

?>