<?php
namespace System\Core;
use \Application\Model;
use function GuzzleHttp\json_encode;

class Controller
{

    private $route;
    private $session;
    private $token;
    private $flashMessages;
    private $arr_dados;

    public function __construct($route = "index", $action = null, $action1 = null)
    {
        $this->arr_dados = array();
        $this->session = new \Application\Model\Session();
        if (
            !$this->session->verifySession() && 
            $route != "index" &&
            $route != "registrar" &&
            $route != "recuperar" &&
            $route != "recuperarsenha"
        ) {
            header("Location: /");
            exit();
        }
        $this->token = new \Application\Model\Token();
        $this->flashMessages = new \Application\Model\FlashMessages();
        if (
            $route == "getdisciplina" || 
            $route == "getdisciplinafiltro" ||
            $route == "getdisciplinafiltrofeed" ||
            $route == "getconteudo" ||
            $route == "getconteudofiltro" ||
            $route == "getconteudofiltrofeed"
            ) {
            eval('$this->'.$route.'("'.$action.'", "'.$action1.'");');
        } else {
            eval('$this->'.$route.'("'.$action.'", "'.$action1.'");');
            $this->load($route, $action, $action1);
        }        
    }

    /*
    *------------------------------------
    * Função responsável por carregar
    * a view
    *-----------------------------------
    *@view Nome do arquivo que se deseja carregar
    *por padrão é o mesmo nome da rota
    */
    public function load($view = "index", $action = null, $action1 = null)
    {
        $arr_dados = $this->arr_dados;
        if (file_exists("application/view/".$view.".php")) {
            require_once("application/view/".$view.".php");
        } else {
            exit("Loader: Invalid view;");
        }
    }


    /*
    *--------------------------------------------------------------------------
    * BEGIN CONTROLLERS ACESSO
    *--------------------------------------------------------------------------
    */

    /*
    *------------------------------------
    * Função responsável por carregar
    * a view index.
    * e pela submissão do formulário
    * do formulário de login
    *-----------------------------------
    *@action parametro 1
    *@action1  parametro 2
    */
    public function index($action = null, $action1 = null)
    {
        if ($this->session->getSession()) {
            header("Location: /homepage");
            exit();
        }   
        if (
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            $action == null &&
            $action1 == null
        ) {
            //Sumbissão do formulário
            $login = $_POST["login"];         
            if ($this->token->verifyToken($login["token"])) {
                $usuario = new \Application\Model\Usuario; 
                $retorno = $usuario->verificarLogin($login); 
                if ($retorno) {
                $this->session->setSession($retorno);
                header("Location: /homepage");
                exit();
                } else {
                $this->flashMessages->adicionaMensagem(
                    "Dados inválidos!", 
                    "2"
                );
                header("Location: /");
                exit();
                }            
            } else {
                $this->flashMessages->adicionaMensagem(
                "Essa requisição já foi feita!", 
                "2"
                );
                header("Location: /homepage");
                exit();
            }
        } else {
            $turma = new \Application\Model\Turma; 
            $arr_turma = $turma->count(); 
            $this->arr_dados["arr_turma"] = $arr_turma;
            $usuario = new \Application\Model\Usuario; 
            $arr_usuario = $usuario->count(); 
            $this->arr_dados["arr_usuario"] = $arr_usuario;
            $arquivo = new \Application\Model\Arquivo; 
            $arr_arquivo = $arquivo->count(); 
            $this->arr_dados["arr_arquivo"] = $arr_arquivo;
            $questao = new \Application\Model\Questao; 
            $arr_questao = $questao->count(); 
            $this->arr_dados["arr_questao"] = $arr_questao;
        }
    }

    /*
    *------------------------------------
    * Função responsável por carregar
    * a view registrar
    * e pela submissão do formulário
    * de registro do usuário
    *-----------------------------------
    *@action parametro 1
    *@action1  parametro 2
    */
    public function registrar($action = null, $action1 = null)
    {
        if (
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            isset($_POST["form-registrar"]) &&
            $action == null &&
            $action1 == null
        ) {
            //Sumbissão do formulário
            $registro = $_POST["registro"];         
            if ($this->token->verifyToken($registro["token"])) {
                if (strlen($registro["password"]) < 8) {
                    $this->flashMessages->adicionaMensagem(
                        "Utilize uma senha com mais de 8 caracteres", 
                        "2"
                    );
                    header("Location: /registrar");
                    exit();
                }
                $usuario = new \Application\Model\Usuario;            
                if ($usuario->registrarUsuario($registro)) {
                $this->flashMessages->adicionaMensagem(
                    "Confirme a criação da sua conta pelo link enviado por email!", 
                    "1"
                );
                header("Location: /");
                exit();
                } else {
                $this->flashMessages->adicionaMensagem(
                    "Ocorreu um erro na operação!", 
                    "2"
                );
                header("Location: /registrar");
                exit();
                }            
            } else {
                $this->flashMessages->adicionaMensagem(
                "Essa requisição já foi feita!", 
                "2"
                );
                header("Location: /");
                exit();
            }
        } elseif (
            $action != null &&
            $action1 != null
        ) {
            //Ativação da conta pelo link do email
            $usuario = new \Application\Model\Usuario;
            if ($usuario->validarConta($action, $action1)) {
                $this->flashMessages->adicionaMensagem(
                "Sua conta está ativa, efetue o login no sistema!", 
                "1"
                );
            } 
            header("Location: /");
            exit();
        }
    }

    /*
    *------------------------------------
    * Função responsável por carregar
    * a view recuperar
    * e pela submissão do formulário
    * de recuperar senha
    *-----------------------------------
    *@action parametro 1
    *@action1  parametro 2
    */
    public function recuperar($action = null, $action1 = null)
    {
        if (
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            isset($_POST["form-recuperar"]) &&
            $action == null &&
            $action1 == null
        ) {
            //Sumbissão do formulário
            $recuperar = $_POST["recuperar"];         
            if ($this->token->verifyToken($recuperar["token"])) {
                $usuario = new \Application\Model\Usuario;            
                if ($usuario->recuperarSenha($recuperar)) {
                $this->flashMessages->adicionaMensagem(
                    "Acesse seu email para recuperar a senha!", 
                    "1"
                );
                header("Location: /");
                exit();
                } else {
                $this->flashMessages->adicionaMensagem(
                    "Ocorreu um erro na operação!", 
                    "2"
                );
                header("Location: /recuperar");
                exit();
                } 
            } else {
                $this->flashMessages->adicionaMensagem(
                "Essa requisição já foi feita!", 
                "2"
                );
                header("Location: /");
                exit();
            }    
        } 
    }

    /*
    *------------------------------------
    * Função responsável por carregar
    * a view recuperar
    * e pela submissão do formulário
    * de recuperar senha
    *-----------------------------------
    *@action parametro 1
    *@action1  parametro 2
    */
    public function recuperarSenha($action = null, $action1 = null)
    {
        if (
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            isset($_POST["form-recuperarsenha"]) &&
            $action != null &&
            $action1 == null
        ) {
            //Sumbissão do formulário
            $recuperarsenha = $_POST["recuperarsenha"];         
            if ($this->token->verifyToken($recuperarsenha["token"])) {
                $usuario = new \Application\Model\Usuario;            
                if ($usuario->trocarSenha($recuperarsenha)) {
                    $this->flashMessages->adicionaMensagem(
                        "Sua senha foi alterada!", 
                        "1"
                    );
                    header("Location: /");
                    exit();
                } else {
                    $this->flashMessages->adicionaMensagem(
                        "Ocorreu um erro na operação!", 
                        "2"
                    );
                    header("Location: /recuperar/".$action1);
                    exit();
                } 
            } else {
                $this->flashMessages->adicionaMensagem(
                "Essa requisição já foi feita!", 
                "2"
                );
                header("Location: /");
                exit();
            }   
        } 
    }

    /*
    *------------------------------------
    * Função responsável por carregar
    * a view e os dados da homepage
    *-----------------------------------
    *@action parametro 1
    *@action1  parametro 2
    */
    public function homepage($action = null, $action1 = null)
    {
        if ($this->session->getSession()) {
            if (
                $_SERVER["REQUEST_METHOD"] == "POST" &&
                isset ($_POST["form-filtro"])
            ) {
                $filtro = $_POST["filtro"];
                $questao = new \Application\Model\Questao;
                $arr_questao = $questao->getQuestaoFiltroFeed($filtro);
                if (!empty($arr_questao)) {
                    $this->arr_dados["arr_questao"] = $arr_questao;
                }   
                $disciplina = new \Application\Model\Disciplina;
                $arr_disciplina = $disciplina->getDisciplinaFiltroFeed($filtro["ciencia"]);
                if (!empty($arr_disciplina)) {
                    $this->arr_dados["arr_disciplina"] = $arr_disciplina;
                }  
                if (
                    isset($filtro["disciplina"]) &&
                    (
                    !empty($filtro["disciplina"]) ||
                    $filtro["disciplina"] != ""
                    )
                ) {
                    $conteudo = new \Application\Model\Conteudo;
                    $arr_conteudo = $conteudo->getConteudoFiltroFeed($filtro["disciplina"]);
                    if (!empty($arr_conteudo)) {
                        $this->arr_dados["arr_conteudo"] = $arr_conteudo;
                    }  
                }
                $this->arr_dados["filtro"] = $filtro;
            } else {
                $questao = new \Application\Model\Questao;
                $arr_questao = $questao->getQuestaoFeed();
                if (!empty($arr_questao)) {
                    $this->arr_dados["arr_questao"] = $arr_questao;
                }               
            }        
            $ciencia = new \Application\Model\Ciencia;             
            $arr_ciencia = $ciencia->getCienciaFiltroFeed();
            if (!empty($arr_ciencia)) {
                $this->arr_dados["arr_ciencia"] = $arr_ciencia;
            }               
        } else {
            header("Location: /");
            exit();
        }

    }

    /*
    *--------------------------------------------------------------------------
    * FIM CONTROLLERS ACESSO
    *--------------------------------------------------------------------------
    */

    /*
    *--------------------------------------------------------------------------
    * BEGIN CONTROLLERS CATEGORIA
    *--------------------------------------------------------------------------
    */
    
    /*
    *------------------------------------
    * Função responsável Listar categorias
    * Route categoria
    *-----------------------------------
    */
    public function categoria($action = null, $action1 = null)
    {
        $categoria = new \Application\Model\Categoria;
        $arr_categorias = $categoria->getCategoria();
        $this->arr_dados["arr_categorias"] = $arr_categorias;
    }

    /*
    *------------------------------------
    * Função responsável Listar categorias
    * Route categoria_cadastrar
    *-----------------------------------
    */
    public function categoria_cadastrar($action = null, $action1 = null)
    {
        if (
            empty($action) &&
            $action == "" &&
            empty($action1) &&
            $action1 == "" &&
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            isset ($_POST["form-categoria"])
        ){
            $post = $_POST["categoria"];
            if ($this->token->verifyToken($post["token"])) {
                $categoria = new \Application\Model\Categoria;
                $categoria->insertCategoria($post);
                header("Location: /categoria");
                exit();
            } else {
                $this->flashMessages->adicionaMensagem(
                "Essa requisição já foi feita!", 
                "2"
                );
                header("Location: /categoria");
                exit();
            }    
        }
    }

    /*
    *------------------------------------
    * Função responsável Listar categorias
    * Route categoria_editar
    *-----------------------------------
    */
    public function categoria_editar($action = null, $action1 = null)
    {
        if (
            !empty($action) &&
            $action != "" &&
            empty($action1) &&
            $action1 == ""
        ){
            $categoria = new \Application\Model\Categoria;
            $categoria = $categoria->getCategoriaById($action);
            if (!$categoria) {
                header("Location: /categoria");
                exit();  
            }
            $this->arr_dados["categoria"] = $categoria;
        }elseif (
            empty($action) &&
            $action == "" &&
            empty($action1) &&
            $action1 == "" &&
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            isset ($_POST["form-categoria"])
        ){
            $post = $_POST["categoria"];
            if ($this->token->verifyToken($post["token"])) {
                $categoria = new \Application\Model\Categoria;
                $categoria->updateCategoria($post);
                header("Location: /categoria");
                exit();
            } else {
                $this->flashMessages->adicionaMensagem(
                "Essa requisição já foi feita!", 
                "2"
                );
                header("Location: /categoria");
                exit();
            }  
        }
    }

    /*
    *------------------------------------
    * Função responsável Listar categorias
    * Route categoria_excluir
    *-----------------------------------
    */
    public function categoria_excluir($action = null, $action1 = null)
    {
        if (
            !empty($action) &&
            $action != "" &&
            empty($action1) &&
            $action1 == ""
        ){
            $categoria = new \Application\Model\Categoria;
            $categoria = $categoria->getCategoriaById($action);
            if (!$categoria) {
                header("Location: /categoria");
                exit();  
            }
            $this->arr_dados["categoria"] = $categoria;
        }elseif (
            empty($action) &&
            $action == "" &&
            empty($action1) &&
            $action1 == "" &&
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            isset ($_POST["form-categoria"])
        ){
            $post = $_POST["categoria"];
            if ($this->token->verifyToken($post["token"])) {
                $categoria = new \Application\Model\Categoria;
                $categoria->deleteCategoria($post);
                header("Location: /categoria");
                exit();
            } else {
                $this->flashMessages->adicionaMensagem(
                "Essa requisição já foi feita!", 
                "2"
                );
                header("Location: /categoria");
                exit();
            }  
        }elseif (
            empty($action) &&
            $action == "" &&
            empty($action1) &&
            $action1 == ""
        ){
            header("Location: /categoria");
            exit();
        }
    }

    /*
    *--------------------------------------------------------------------------
    * FIM CONTROLLERS CATEGORIA
    *--------------------------------------------------------------------------
    */

   
    /*
    *--------------------------------------------------------------------------
    * BEGIN CONTROLLERS ARQUIVOS
    *--------------------------------------------------------------------------
    */

    /*
    *------------------------------------
    * Função responsável Listar arquivos
    * Route arquivo
    *-----------------------------------
    */
    public function arquivo($action = null, $action1 = null)
    {
        /* ALLTERAR PARA FILTRO
        $categoria = new \Application\Model\Categoria;
        $arr_categorias = $categoria->getCategoria();
        $this->arr_dados["arr_categorias"] = $arr_categorias;
        */
        $arquivo = new \Application\Model\Arquivo;
        $arr_arquivos = $arquivo->getArquivos($action);
        $arr_aquivos_link = array();
        if (!empty($arr_arquivos)) {
            foreach ($arr_arquivos as $arq) {
                $arr_arquivos_link[] = array(
                    "arquivo_id" => $arq["arquivo_id"],
                    "descricao" => $arq["descricao"],
                    "categoria" => $arq["categoria"],
                    "criacao" => $arq["criacao"],
                    "link" => $arquivo->getBancoDeQuestao(
                                $arq["arquivo_id"]
                            )
                );
            }   
            $this->arr_dados["arr_arquivos"] = $arr_arquivos_link;
        }                
    }

    /*
    *------------------------------------
    * Função responsável cadastrar arquivos
    * Route arquivo
    *-----------------------------------
    */
    public function arquivo_cadastrar($action = null, $action1 = null)
    {
        if (
            empty($action) &&
            $action == "" &&
            empty($action1) &&
            $action1 == "" &&
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            isset ($_POST["form-arquivo"])
        ){
            $post = $_POST["arquivo"];
            $files = $_FILES;
            if ($this->token->verifyToken($post["token"])) {
                $arquivo = new \Application\Model\Arquivo;
                $arquivo->insertArquivo($post, $files);
                header("Location: /arquivo");
                exit();
            } else {
                $this->flashMessages->adicionaMensagem(
                "Essa requisição já foi feita!", 
                "2"
                );
                header("Location: /arquivo");
                exit();
            }    
        }elseif (
            empty($action) &&
            $action == "" &&
            empty($action1) &&
            $action1 == ""
        ){
            $categoria = new \Application\Model\Categoria;
            $arr_categorias = $categoria->getCategoria();
            $this->arr_dados["arr_categorias"] = $arr_categorias;
        }
    }

    /*
    *------------------------------------
    * Função responsável editar arquivos
    * Route arquivo
    *-----------------------------------
    */
    public function arquivo_editar($action = null, $action1 = null)
    {
        if (
            empty($action) &&
            $action == "" &&
            empty($action1) &&
            $action1 == "" &&
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            isset ($_POST["form-arquivo"])
        ){
            $post = $_POST["arquivo"];
            $files = $_FILES;
            if ($this->token->verifyToken($post["token"])) {
                $arquivo = new \Application\Model\Arquivo;
                $arquivo->updateArquivo($post, $files);
                header("Location: /arquivo");
                exit();
            } else {
                $this->flashMessages->adicionaMensagem(
                "Essa requisição já foi feita!", 
                "2"
                );
                header("Location: /arquivo");
                exit();
            }    
        }elseif (
            !empty($action) &&
            $action != "" &&
            empty($action1) &&
            $action1 == ""
        ){
            $categoria = new \Application\Model\Categoria;
            $arr_categorias = $categoria->getCategoria();
            $this->arr_dados["arr_categorias"] = $arr_categorias;
            $arquivo = new \Application\Model\Arquivo;
            $this->arr_dados["arr_arquivo"] = $arquivo->getArquivoById($action);
            if ($this->arr_dados["arr_arquivo"] == null) {
                $this->flashMessages->adicionaMensagem(
                    "Nada encontrado!", 
                    "2"
                );
                header("Location: /arquivo");
                exit();
            }
            $this->arr_dados["arr_arquivo"]["link"] = 
            $arquivo->getBancoDeQuestao(
                $this->arr_dados["arr_arquivo"]["arquivo_id"]
            );
        }
    }

    /*
    *------------------------------------
    * Função responsável pelo download arquivos
    * Route arquivo
    *-----------------------------------
    */
    public function arquivo_download($action = null, $action1 = null)
    {
        if (
            !empty($action) &&
            $action != "" &&
            !empty($action1) &&
            $action1 != "" &&
            md5($this->session->getSession()) == $action1
        ){        
            $arquivo = new \Application\Model\Arquivo;
            $this->arr_dados["arr_arquivo"] = $arquivo->getArquivoById($action);           
        } else {
            $this->flashMessages->adicionaMensagem(
                "Nada encontrado!", 
                "2"
            );
            header("Location: /arquivo");
            exit();
        }
    }

    /*
    *------------------------------------
    * Função responsável excluir arquivo
    * Route arquivo_excluir
    *-----------------------------------
    */
    public function arquivo_excluir($action = null, $action1 = null)
    {
        if (
            !empty($action) &&
            $action != "" &&
            empty($action1) &&
            $action1 == ""
        ){
            $arquivo = new \Application\Model\Arquivo;
            $arr_arquivo = $arquivo->getArquivoById($action);
            if (!$arquivo) {
                header("Location: /arquivo");
                exit();  
            }            
            $this->arr_dados["arr_arquivo"] = $arr_arquivo;
        }elseif (
            empty($action) &&
            $action == "" &&
            empty($action1) &&
            $action1 == "" &&
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            isset ($_POST["form-arquivo"])
        ){
            $post = $_POST["arquivo"];
            if ($this->token->verifyToken($post["token"])) {
                $arquivo = new \Application\Model\Arquivo;
                $arquivo->deleteArquivo($post);
                header("Location: /arquivo");
                exit();
            } else {
                $this->flashMessages->adicionaMensagem(
                "Essa requisição já foi feita!", 
                "2"
                );
                header("Location: /arquivo");
                exit();
            }  
        }elseif (
            empty($action) &&
            $action == "" &&
            empty($action1) &&
            $action1 == ""
        ){
            header("Location: /arquivo");
            exit();
        }
    }

    /*
    *--------------------------------------------------------------------------
    * FIM CONTROLLERS ARQUIVOS
    *--------------------------------------------------------------------------
    */

    /*
    *--------------------------------------------------------------------------
    * BEGIN CONTROLLERS CONTROLE DE CLASSE
    *--------------------------------------------------------------------------
    */

    /*
    *------------------------------------
    * Função responsável Listar alunos
    * Route aluno
    *-----------------------------------
    */
    public function aluno($action = null, $action1 = null)
    {
        $aluno = new \Application\Model\Aluno;
        $arr_alunos = $aluno->getAlunos();
        if (!empty($arr_alunos)) {                
            $this->arr_dados["arr_alunos"] = $arr_alunos;
        }                
    }

    /*
    *------------------------------------
    * Função responsável cadastrar alunos
    * Route aluno_cadastrar
    *-----------------------------------
    */
    public function aluno_cadastrar($action = null, $action1 = null)
    {
        if (
            empty($action) &&
            $action == "" &&
            empty($action1) &&
            $action1 == "" &&
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            isset ($_POST["form-aluno"])
        ){
            $post = $_POST["aluno"];
            $files = $_FILES;
            if ($this->token->verifyToken($post["token"])) {
                $aluno = new \Application\Model\Aluno;
                $aluno->insertAluno($post);
                header("Location: /aluno");
                exit();
            } else {
                $this->flashMessages->adicionaMensagem(
                "Essa requisição já foi feita!", 
                "2"
                );
                header("Location: /aluno");
                exit();
            }    
        }
    }

    /*
    *------------------------------------
    * Função responsável editar aluno
    * Route aluno_editar
    *-----------------------------------
    */
    public function aluno_editar($action = null, $action1 = null)
    {
        if (
            !empty($action) &&
            $action != "" &&
            empty($action1) &&
            $action1 == ""
        ){
            $aluno = new \Application\Model\Aluno;
            $aluno = $aluno->getAlunoById($action);
            if (!$aluno) {
                header("Location: /aluno");
                exit();  
            }
            $this->arr_dados["aluno"] = $aluno;
        }elseif (
            empty($action) &&
            $action == "" &&
            empty($action1) &&
            $action1 == "" &&
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            isset ($_POST["form-aluno"])
        ){
            $post = $_POST["aluno"];
            if ($this->token->verifyToken($post["token"])) {
                $aluno = new \Application\Model\Aluno;
                $aluno->updateAluno($post);
                header("Location: /aluno");
                exit();
            } else {
                $this->flashMessages->adicionaMensagem(
                "Essa requisição já foi feita!", 
                "2"
                );
                header("Location: /aluno");
                exit();
            }  
        }
    }

    /*
    *------------------------------------
    * Função responsável excluir aluno
    * Route aluno_excluir
    *-----------------------------------
    */
    public function aluno_excluir($action = null, $action1 = null)
    {
        if (
            !empty($action) &&
            $action != "" &&
            empty($action1) &&
            $action1 == ""
        ){
            $aluno = new \Application\Model\Aluno;
            $arr_alunos = $aluno->getAlunoById($action);
            if (!$arr_alunos) {
                header("Location: /aluno");
                exit();  
            }            
            $this->arr_dados["aluno"] = $arr_alunos;
        }elseif (
            empty($action) &&
            $action == "" &&
            empty($action1) &&
            $action1 == "" &&
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            isset ($_POST["form-aluno"])
        ){
            $post = $_POST["aluno"];
            if ($this->token->verifyToken($post["token"])) {
                $aluno = new \Application\Model\Aluno;
                $aluno->deleteAluno($post);
                header("Location: /aluno");
                exit();
            } else {
                $this->flashMessages->adicionaMensagem(
                "Essa requisição já foi feita!", 
                "2"
                );
                header("Location: /aluno");
                exit();
            }  
        }elseif (
            empty($action) &&
            $action == "" &&
            empty($action1) &&
            $action1 == ""
        ){
            header("Location: /aluno");
            exit();
        }
    }

    /*
    *------------------------------------
    * Função responsável Listar turmas
    * Route turma
    *-----------------------------------
    */
    public function turma($action = null, $action1 = null)
    {
        $turma = new \Application\Model\Turma;
        $arr_turmas = $turma->getTurmas($action);
        if (!empty($arr_turmas)) {
            $this->arr_dados["arr_turmas"] = $arr_turmas;
        }                
    }

    /*
    *------------------------------------
    * Função responsável cadastrar turmas
    * Route turma_cadastrar
    *-----------------------------------
    */
    public function turma_cadastrar($action = null, $action1 = null)
    {
        if (
            empty($action) &&
            $action == "" &&
            empty($action1) &&
            $action1 == "" &&
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            isset ($_POST["form-turma"])
        ){
            $post = $_POST["turma"];
            $files = $_FILES;
            if ($this->token->verifyToken($post["token"])) {
                $turma = new \Application\Model\Turma;
                $turma->insertTurma($post);
                header("Location: /turma");
                exit();
            } else {
                $this->flashMessages->adicionaMensagem(
                "Essa requisição já foi feita!", 
                "2"
                );
                header("Location: /turma");
                exit();
            }    
        }
    }

    /*
    *------------------------------------
    * Função responsável editar turma
    * Route turma_editar
    *-----------------------------------
    */
    public function turma_editar($action = null, $action1 = null)
    {        
        if (
            !empty($action) &&
            $action != "" &&
            empty($action1) &&
            $action1 == ""
        ){
            $turma = new \Application\Model\Turma;
            $turma = $turma->getTurmaById($action);
            if (!$turma) {
                header("Location: /turma");
                exit();  
            }
            $this->arr_dados["turma"] = $turma;
        }elseif (
            empty($action) &&
            $action == "" &&
            empty($action1) &&
            $action1 == "" &&
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            isset ($_POST["form-turma"])
        ){
            $post = $_POST["turma"];
            if ($this->token->verifyToken($post["token"])) {
                $turma = new \Application\Model\Turma;
                $turma->updateTurma($post);
                header("Location: /turma");
                exit();
            } else {
                $this->flashMessages->adicionaMensagem(
                "Essa requisição já foi feita!", 
                "2"
                );
                header("Location: /turma");
                exit();
            }  
        }
    }

    /*
    *------------------------------------
    * Função responsável excluir turma
    * Route turma_excluir
    *-----------------------------------
    */
    public function turma_excluir($action = null, $action1 = null)
    {
        if (
            !empty($action) &&
            $action != "" &&
            empty($action1) &&
            $action1 == ""
        ){
            $turma = new \Application\Model\Turma;
            $arr_turmas = $turma->getTurmaById($action);
            if (!$arr_turmas) {
                header("Location: /turma");
                exit();  
            }            
            $this->arr_dados["turmas"] = $arr_turmas;
        }elseif (
            empty($action) &&
            $action == "" &&
            empty($action1) &&
            $action1 == "" &&
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            isset ($_POST["form-turma"])
        ){
            $post = $_POST["turma"];
            if ($this->token->verifyToken($post["token"])) {
                $turma = new \Application\Model\Turma;
                $turma->deleteTurma($post);
                header("Location: /turma");
                exit();
            } else {
                $this->flashMessages->adicionaMensagem(
                "Essa requisição já foi feita!", 
                "2"
                );
                header("Location: /turma");
                exit();
            }  
        }elseif (
            empty($action) &&
            $action == "" &&
            empty($action1) &&
            $action1 == ""
        ){
            header("Location: /turna");
            exit();
        }
    }

    /*
    *------------------------------------
    * Função responsável gerenciar alunos
    * da turma
    * Route turma_gerenciar
    *-----------------------------------
    */
    public function turma_gerenciar($action = null, $action1 = null)
    {
        if (
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            isset($_POST["form-vincular"])
        ) {
            $post = $_POST["vinculo"];
            if ($this->token->verifyToken($post["token"])) {
                $turma = new \Application\Model\Turma;
                if ($turma->vinculaAluno($post)) {
                    $this->flashMessages->adicionaMensagem(
                        "O aluno foi vinculado!", 
                        "1"
                    );
                } else {
                    $this->flashMessages->adicionaMensagem(
                        "Ocorreu um erro ao vincular o aluno!", 
                        "2"
                    );
                }
                header("Location: /turma_gerenciar/".$post["turma_id"]);
                exit();
            } else {
                $this->flashMessages->adicionaMensagem(
                "Essa requisição já foi feita!", 
                "2"
                );
                header("Location: /turma");
                exit();
            }  
            
        } else if (
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            isset($_POST["form-desvincular"])
        ) {
            $post = $_POST["vinculo"];
            if ($this->token->verifyToken($post["token"])) {
                $turma = new \Application\Model\Turma;
                if ($turma->desvinculaAluno($post)) {
                    $this->flashMessages->adicionaMensagem(
                        "O aluno foi desvinculado!", 
                        "1"
                    );
                } else {
                    $this->flashMessages->adicionaMensagem(
                        "Ocorreu um erro ao desvincular o aluno!", 
                        "2"
                    );
                }
                header("Location: /turma_gerenciar/".$post["turma_id"]);
                exit();
            } else {
                $this->flashMessages->adicionaMensagem(
                "Essa requisição já foi feita!", 
                "2"
                );
                header("Location: /turma");
                exit();
            }  
            
        } else  if (
            !empty($action) &&
            $action != "" &&
            empty($action1) &&
            $action1 == ""
        ){
            $turma = new \Application\Model\Turma;
            //$action referencia o id da turma
            $arr_turma = $turma->getTurmaById($action);      
            if (!empty($arr_turma)) {
                $this->arr_dados["arr_turma"] = $arr_turma;
            }         
            $aluno = new \Application\Model\Aluno;
            //$action referencia o id da turma
            $arr_alunos = $aluno->getAlunosGerenciar($action);  
            if (!empty($arr_alunos)) {
                $this->arr_dados["arr_alunos"] = $arr_alunos;
            }
        } else {
            header("Location: /turma");
            exit();
        }     
    }


    /*
    *------------------------------------
    * Função responsável gerenciar prova
    * da turma
    * Route turma_prova
    *-----------------------------------
    */
    public function turma_prova($action = null, $action1 = null)
    {
        //Teste
        if (
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            isset($_POST["form-prova"])
        ){
            $post_avaliacao = $_POST["avaliacao"];
            if (!$this->token->verifyToken($post_avaliacao["token"])) {
                $this->flashMessages->adicionaMensagem(
                    "Essa requisição já foi feita!", 
                    "2"
                );
                header("Location: /turma");
                exit();
            }            
            $avaliacao = new \Application\Model\Avaliacao;
            $oper = true;
            if (!$avaliacao->updateAvaliacao($post_avaliacao))  {
                $oper = false;
            }
            $post_nota = $_POST["nota"];
            $nota = new \Application\Model\Nota;
            if (!$nota->updateNota($post_nota)) {
                $oper = false;
            }
            
            if ($oper) {
                $this->flashMessages->adicionaMensagem(
                    "Dados gravados!", 
                    "1"
                );
            }

            header("Location: /turma_prova/".$_GET["action"]."/".$_GET["action1"]);
            exit();
        } else  if (
            !empty($action) &&
            $action != "" &&
            !empty($action1) &&
            $action1 != ""
        ){
            $turma = new \Application\Model\Turma;
            //$action referencia o id da turma
            $arr_turma = $turma->getTurmaById($action);      
            if (!empty($arr_turma)) {
                $this->arr_dados["arr_turma"] = $arr_turma;
            }         
            $aluno = new \Application\Model\Aluno;
            if ($arr_turma["status"] == "2") {
                $flashMessages = new \Application\Model\FlashMessages;
                $flashMessages->adicionaMensagem("Turma já finalizada!", "2");
                header("Location: /turma");
                exit();
            }
            if ($arr_turma["quantidade_avaliacao"] < $action1) {
                $flashMessages = new \Application\Model\FlashMessages;
                $flashMessages->adicionaMensagem("Ultrapassou o limite máximo de avaliações!", "2");
                header("Location: /turma");
                exit();
            }
            $avaliacao = new \Application\Model\Avaliacao;
            //action turma_id, action1 numero avaliacao
            $arr_avaliacao = $avaliacao->verificaAvaliacao($action, $action1);
            if ($arr_avaliacao) {
                $this->arr_dados["arr_avaliacao"] = $arr_avaliacao;
            } else {
                $flashMessages->adicionaMensagem("Erro criação da avaliação", "2");
                header("Location: /turma");
                exit();
            }
            //$action referencia o id da turma
            $arr_alunos = $turma->getVinculos($action, $action1);
            if ($arr_alunos) {
                //$this->arr_dados["arr_alunos"] = $arr_alunos;
                $avaliacao->verificaNota($arr_alunos, $arr_avaliacao["avaliacao_id"]);
                $this->arr_dados["arr_notas"] = $avaliacao->getNotasAvaliacaoId(
                                                    $arr_avaliacao["avaliacao_id"]
                                                );
            } else {
                $this->flashMessages->adicionaMensagem("Nenhum aluno vinculado", "2");
                header("Location: /turma");
                exit();
            }

        } else {
            header("Location: /turma");
            exit();
        }     
    }


    /*
    *------------------------------------
    * Função responsável Listar o diário
    * de classe
    *-----------------------------------
    */
    public function turma_diario($action = null, $action1 = null)
    {
        $turma = new \Application\Model\Turma;
        //$action referencia o id da turma
        if ($turma->verificaTurmaSession($action)) {
            $arr_turma = $turma->getTurmaById($action);      
            if (!empty($arr_turma)) {
                $this->arr_dados["arr_turmas"] = $arr_turma;
            }      
            $diario = new \Application\Model\Diario;
            $arr_diario = $diario->getDiarios($action);
            $this->arr_dados["arr_diarios"] = $arr_diario;
        } else {
            $this->flashMessages->adicionaMensagem("Erro de identificação", "2");
            header("Location: /turma");
            exit();
        }       
    }

    /*
    *------------------------------------
    * Função responsável por mostrar form
    * e gravar diário
    *-----------------------------------
    */
    public function turma_diario_cadastrar($action = null, $action1 = null)
    {
        if (
            !empty($action) &&
            $action != "" &&
            (
                $action1 == "" ||
                empty($action1)
            )
        ) {
            $turma = new \Application\Model\Turma;
            //$action referencia o id da turma
            if ($turma->verificaTurmaSession($action)) {
                $arr_turma = $turma->getTurmaById($action);      
                if (!empty($arr_turma)) {
                    $this->arr_dados["arr_turmas"] = $arr_turma;
                }
                $aluno = new \Application\Model\Aluno;
                //$action referencia o id da turma
                if ($arr_aluno = $aluno->getAlunosVincular($action)) {
                    $this->arr_dados["arr_alunos"] = $arr_aluno;
                } else {
                    $this->flashMessages->adicionaMensagem("Nenhum aluno vinculado", "2");
                    header("Location: /turma");
                    exit();
                }
                
            } else {
                header("Location: /turma");
                exit();
            }
        }

        if (
            empty($action) &&
            $action == "" &&
            empty($action1) &&
            $action1 == "" &&
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            isset ($_POST["form-diario"])
        ){
            $post = $_POST["diario"];
            $form = $_POST["form"];;
            $turma = new \Application\Model\Turma;
            //$action referencia o id da turma
            if ($turma->verificaTurmaSession($form["turma_id"])) {
                if ($this->token->verifyToken($form["token"])) {
                    $diario = new \Application\Model\Diario;
                    if ($diario->insertDiario($form, $post)) {
                        header("Location: /turma_diario/".$form["turma_id"]);
                        exit();
                    } else {
                        header("Location: /turma");
                        exit();
                    }
                } else {
                    $this->flashMessages->adicionaMensagem("Token inválido", "2");
                    header("Location: /turma");
                    exit();
                }
            } else {
                header("Location: /turma");
                exit();
            }

        }
    }

    /*
    *------------------------------------
    * Função responsável por mostrar form
    * e gravar diário
    *-----------------------------------
    */
    public function turma_diario_editar($action = null, $action1 = null)
    {
        if (
            !empty($action) &&
            $action != "" &&
            $action1 != "" &&
            !empty($action1)
        ) {
            $turma = new \Application\Model\Turma;
            //$action referencia o id da turma
            if ($turma->verificaTurmaSession($action)) {
                $arr_turma = $turma->getTurmaById($action);      
                if (!empty($arr_turma)) {
                    $this->arr_dados["arr_turmas"] = $arr_turma;
                }
                $diario = new \Application\Model\Diario;
                //$action referencia o id da turma
                if ($arr_aluno = $diario->getDiarioEditar($action, $action1)) {
                    $this->arr_dados["arr_alunos"] = $arr_aluno;
                } else {
                    $this->flashMessages->adicionaMensagem("Nenhum aluno vinculado", "2");
                    header("Location: /turma");
                    exit();
                }    
                if ($arr_data = $diario->getData($action, $action1)) {
                    $this->arr_dados["arr_data"] = $arr_data;
                } else {
                    $this->flashMessages->adicionaMensagem("Falha ao carregar data", "2");
                    header("Location: /turma");
                    exit();
                }            
            } else {
                header("Location: /turma");
                exit();
            }
        }

        if (
            empty($action) &&
            $action == "" &&
            empty($action1) &&
            $action1 == "" &&
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            isset ($_POST["form-diario"])
        ){
            $post = $_POST["diario"];
            $form = $_POST["form"];;
            $turma = new \Application\Model\Turma;
            //$action referencia o id da turma
            if ($turma->verificaTurmaSession($form["turma_id"])) {
                if ($this->token->verifyToken($form["token"])) {
                    $diario = new \Application\Model\Diario;
                    if ($diario->updateDiario($form, $post)) {
                        header("Location: /turma_diario/".$form["turma_id"]);
                        exit();
                    } else {
                        header("Location: /turma");
                        exit();
                    }
                } else {
                    $this->flashMessages->adicionaMensagem("Token inválido", "2");
                    header("Location: /turma");
                    exit();
                }
            } else {
                header("Location: /turma");
                exit();
            }

        }
    }


    /*
    *------------------------------------
    * Função responsável por mostrar form
    * e gravar diário
    *-----------------------------------
    */
    public function turma_diario_excluir($action = null, $action1 = null)
    {
        if (
            !empty($action) &&
            $action != "" &&
            $action1 != "" &&
            !empty($action1)
        ) {
            $turma = new \Application\Model\Turma;
            //$action referencia o id da turma
            if ($turma->verificaTurmaSession($action)) {
                $arr_turma = $turma->getTurmaById($action);      
                if (!empty($arr_turma)) {
                    $this->arr_dados["arr_turmas"] = $arr_turma;
                }
                $diario = new \Application\Model\Diario;
                //$action referencia o id da turma   
                if ($arr_data = $diario->getData($action, $action1)) {
                    $this->arr_dados["arr_data"] = $arr_data;
                } else {
                    $this->flashMessages->adicionaMensagem("Falha ao carregar data", "2");
                    header("Location: /turma");
                    exit();
                }        
                if ($arr_data = $diario->getDate($action, $action1)) {
                    $this->arr_dados["arr_date"] = $arr_data;
                } else {
                    $this->flashMessages->adicionaMensagem("Falha ao carregar data", "2");
                    header("Location: /turma");
                    exit();
                }       
            } else {
                header("Location: /turma");
                exit();
            }
        }

        if (
            empty($action) &&
            $action == "" &&
            empty($action1) &&
            $action1 == "" &&
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            isset ($_POST["form-data"])
        ){
            $post = $_POST["diario"];
            $turma = new \Application\Model\Turma;
            //$action referencia o id da turma
            if ($turma->verificaTurmaSession($post["turma_id"])) {
                if ($this->token->verifyToken($post["token"])) {
                    $diario = new \Application\Model\Diario;
                    if ($diario->deleteDiario($post)) {
                        header("Location: /turma_diario/".$post["turma_id"]);
                        exit();
                    } else {
                        exit();
                        header("Location: /turma");
                        exit();
                    }
                } else {
                    $this->flashMessages->adicionaMensagem("Token inválido", "2");
                    header("Location: /turma");
                    exit();
                }
            } else {
                header("Location: /turma");
                exit();
            }

        }
    }
    
    /*
    *------------------------------------
    * Função responsável Listar 
    * relatório da turma
    *-----------------------------------
    */
    public function turma_relatorio($action = null, $action1 = null)
    {
        $turma = new \Application\Model\Turma;
        //$action referencia o id da turma
        if ($turma->verificaTurmaSession($action)) {
            $arr_turma = $turma->getTurmaById($action);      
            if (!empty($arr_turma)) {
                $this->arr_dados["arr_turmas"] = $arr_turma;
            }      
            $aluno = new \Application\Model\Aluno;
            $arr_aluno = $aluno->getAlunosByTurmaId($action);
            if (!empty($arr_aluno)) {
                $this->arr_dados["arr_alunos"] = $arr_aluno;
            }  
        } else {
            $this->flashMessages->adicionaMensagem("Erro de identificação", "2");
            header("Location: /turma");
            exit();
        }       
    }

    /*
    *------------------------------------
    * Função responsável Listar 
    * relatório da turma
    *-----------------------------------
    */
    public function turma_relatorio_individual($action = null, $action1 = null)
    {
        $turma = new \Application\Model\Turma;
        //$action referencia o id da turma
        if ($turma->verificaTurmaSession($action)) {
            $arr_turma = $turma->getTurmaById($action);      
            if (!empty($arr_turma)) {
                $this->arr_dados["arr_turmas"] = $arr_turma;
            }      
            $aluno = new \Application\Model\Aluno;
            $arr_aluno = $aluno->getAlunoById($action1);
            if (empty($arr_aluno)) {
                $this->flashMessages->adicionaMensagem("Erro de identificação", "2");
                header("Location: /turma");
                exit();
            }  
            $this->arr_dados["arr_alunos"] = $arr_aluno;
            $nota = new \Application\Model\Nota;
            $arr_nota = $nota->getNotasAluno($action1, $action);
            if (!empty($arr_nota)) {
                $this->arr_dados["arr_nota"] = $arr_nota;
            }            
            $arr_media = $nota->getMedia($action1, $action, $arr_turma["quantidade_avaliacao"]);
            if (!empty($arr_media)) {
                $this->arr_dados["arr_media"] = $arr_media;
            }
            $diario = new \Application\Model\Diario;
            $arr_diario = $diario->getDiarioAlunoTurma($action, $action1);
            if (!empty($arr_diario)) {
                $this->arr_dados["arr_diario"] = $arr_diario;
            }
        } else {
            $this->flashMessages->adicionaMensagem("Erro de identificação", "2");
            header("Location: /turma");
            exit();
        }       
    }


    /*
    *--------------------------------------------------------------------------
    * FIM CONTROLLERS CONTROLE DE CLASSE
    *--------------------------------------------------------------------------
    */

    /*
    *--------------------------------------------------------------------------
    * BEGIN CONTROLLERS BANCO DE QUESTAO
    *--------------------------------------------------------------------------
    */

    /*
    *------------------------------------
    * Função responsável Listar turmas
    * Route turma
    *-----------------------------------
    */
    public function questao($action = null, $action1 = null)
    {
        if (
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            isset ($_POST["form-filtro"])
        ) {
            $filtro = $_POST["filtro"];
            $questao = new \Application\Model\Questao;
            $arr_questao = $questao->getQuestaoFiltro($filtro);
            if (!empty($arr_questao)) {
                $this->arr_dados["arr_questao"] = $arr_questao;
            }   
            $disciplina = new \Application\Model\Disciplina;
            $arr_disciplina = $disciplina->getDisciplinaFiltro($filtro["ciencia"]);
            if (!empty($arr_disciplina)) {
                $this->arr_dados["arr_disciplina"] = $arr_disciplina;
            }  
            if (
                isset($filtro["disciplina"]) &&
                (
                !empty($filtro["disciplina"]) ||
                $filtro["disciplina"] != ""
                )
            ) {
                $conteudo = new \Application\Model\Conteudo;
                $arr_conteudo = $conteudo->getConteudoFiltro($filtro["disciplina"]);
                if (!empty($arr_conteudo)) {
                    $this->arr_dados["arr_conteudo"] = $arr_conteudo;
                }  
            }
            $this->arr_dados["filtro"] = $filtro;
        } else {
            $questao = new \Application\Model\Questao;
            $arr_questao = $questao->getQuestao();
            if (!empty($arr_questao)) {
                $this->arr_dados["arr_questao"] = $arr_questao;
            }               
        }        
        $ciencia = new \Application\Model\Ciencia;             
        $arr_ciencia = $ciencia->getCienciaFiltro();
        if (!empty($arr_ciencia)) {
            $this->arr_dados["arr_ciencia"] = $arr_ciencia;
        }               
        
        
    }

    /*
    *------------------------------------
    * Função responsável cadastrar questao
    * Route questao_cadastrar
    *-----------------------------------
    */
    public function questao_cadastrar($action = null, $action1 = null)
    {
        if (
            empty($action) &&
            $action == "" &&
            empty($action1) &&
            $action1 == "" &&
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            isset ($_POST["form-questao"])
        ){
            $questao = $_POST["questao"];
            $objetiva = $_POST["objetiva"];
            $descritiva = $_POST["descritiva"];
            if ($this->token->verifyToken($questao["token"])) {
                if ($questao["tipo"] == "1") {
                    $obj_questao = new \Application\Model\Questao;
                    $obj_questao->insertDescritiva($questao, $descritiva);
                    header("Location: /questao");
                    exit();
                } elseif ($questao["tipo"] == "2") {
                    $obj_questao = new \Application\Model\Questao;
                    $obj_questao->insertObjetiva($questao, $objetiva, $_POST["correta"]);
                    header("Location: /questao");
                    exit();
                }
                
            } else {
                $this->flashMessages->adicionaMensagem(
                "Essa requisição já foi feita!", 
                "2"
                );
                header("Location: /questao");
                exit();
            } 
            
        } else {
            $ciencia = new \Application\Model\Ciencia;             
            $arr_ciencia = $ciencia->getCiencia();
            if (!empty($arr_ciencia)) {
                $this->arr_dados["arr_ciencia"] = $arr_ciencia;
            }
        }
        
    }


    /*
    *------------------------------------
    * Função responsável cadastrar questao
    * Route questao_cadastrar
    *-----------------------------------
    */
    public function questao_editar($action = null, $action1 = null)
    {
        if (
            empty($action) &&
            $action == "" &&
            empty($action1) &&
            $action1 == "" &&
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            isset ($_POST["form-questao"])
        ){
            $questao = $_POST["questao"];
            if (isset($_POST["objetiva"])) {
                $objetiva = $_POST["objetiva"];
            }
            if (isset($_POST["descritiva"])) {
                $descritiva = $_POST["descritiva"];
            }
            if ($this->token->verifyToken($questao["token"])) {
                if ($questao["tipo"] == "1") {
                    $obj_questao = new \Application\Model\Questao;
                    $obj_questao->updateDescritiva($questao, $descritiva, $_POST["descritiva_id"]);
                    header("Location: /questao");
                    exit();
                } elseif ($questao["tipo"] == "2") {
                    $obj_questao = new \Application\Model\Questao;
                    $obj_questao->updateObjetiva($questao, $objetiva);
                    header("Location: /questao");
                    exit();
                }
                
            } else {
                $this->flashMessages->adicionaMensagem(
                "Essa requisição já foi feita!", 
                "2"
                );
                header("Location: /questao");
                exit();
            } 
            
        } else {
            $questao = new \Application\Model\Questao;
            $arr_questao = $questao->getQuestaoById($action);
            if (empty($arr_questao)) {
                $this->flashMessages->adicionaMensagem(
                    "Nada encontrado!",
                    "2"
                );
                header("Location: /questao");
            }
            $this->arr_dados["arr_questao"] = $arr_questao;
            $ciencia = new \Application\Model\Ciencia;             
            $arr_ciencia = $ciencia->getCiencia();
            if (!empty($arr_ciencia)) {
                $this->arr_dados["arr_ciencia"] = $arr_ciencia;
            }
            $disciplina = new \Application\Model\Disciplina;             
            $arr_disciplina = $disciplina->getDisciplina($arr_questao["ciencia_id"]);
            if (!empty($arr_disciplina)) {
                $this->arr_dados["arr_disciplina"] = $arr_disciplina;
            }
            $conteudo = new \Application\Model\Conteudo;
            $arr_conteudo = $conteudo->getConteudo($arr_questao["disciplina_id"]);
            if (!empty($arr_conteudo)) {
                $this->arr_dados["arr_conteudo"] = $arr_conteudo;
            }            
        }
        
    }


    /*
    *------------------------------------
    * Função responsável cadastrar questao
    * Route questao_cadastrar
    *-----------------------------------
    */
    public function questao_excluir($action = null, $action1 = null)
    {
        if (
            empty($action) &&
            $action == "" &&
            empty($action1) &&
            $action1 == "" &&
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            isset ($_POST["form-questao"])
        ){
            $questao = $_POST["questao"];
            if ($this->token->verifyToken($questao["token"])) {
                if (
                    !empty($questao["questao_id"]) &&
                    $questao["questao_id"] != "" &&
                    is_numeric($questao["questao_id"])
                ) {
                    $obj_questao = new \Application\Model\Questao;
                    $obj_questao->deleteQuestao($questao["questao_id"]);
                    header("Location: /questao");
                    exit();
                }
                header("Location: /questao");
                exit();
            } else {
                $this->flashMessages->adicionaMensagem(
                "Essa requisição já foi feita!", 
                "2"
                );
                header("Location: /questao");
                exit();
            } 
            
        } elseif (
            !empty($action) &&
            $action != "" &&
            (empty($action1)
            || 
            $action1 == "")
        ) {
            $questao = new \Application\Model\Questao;
            $arr_questao = $questao->getQuestaoPrint($action);
            if (empty($arr_questao)) {
                $this->flashMessages->adicionaMensagem(
                    "Nada encontrado!",
                    "2"
                );
                header("Location: /questao");
            }
            $this->arr_dados["arr_questao"] = $arr_questao;  
            $arr_resposta = $questao->getQuestaoResposta($arr_questao["questao_id"], $arr_questao["tipo"]);
            if (empty($arr_resposta)) {
                $this->flashMessages->adicionaMensagem(
                    "Nada encontrado!",
                    "2"
                );
                header("Location: /questao");
            }
            $this->arr_dados["arr_resposta"] = $arr_resposta;
        }
        
    }


    /*
    *------------------------------------
    * Função responsável cadastrar questao
    * Route questao_cadastrar
    *-----------------------------------
    */
    public function questao_visualizar($action = null, $action1 = null)
    {
        if (
            !empty($action) &&
            $action != "" &&
            (empty($action1)
            || 
            $action1 == "")
        ) {
            $questao = new \Application\Model\Questao;
            $arr_questao = $questao->getQuestaoPrint($action);
            if (empty($arr_questao)) {
                $this->flashMessages->adicionaMensagem(
                    "Nada encontrado!",
                    "2"
                );
                header("Location: /homepage");
            }
            $this->arr_dados["arr_questao"] = $arr_questao;  
            $arr_resposta = $questao->getQuestaoResposta($arr_questao["questao_id"], $arr_questao["tipo"]);
            if (empty($arr_resposta)) {
                $this->flashMessages->adicionaMensagem(
                    "Nada encontrado!",
                    "2"
                );
                header("Location: /homepage");
            }
            $this->arr_dados["arr_resposta"] = $arr_resposta;
        }
        
    }


    /*
    *--------------------------------------------------------------------------
    * FIM CONTROLLERS BANCO DE QUESTAO
    *----------
    
    ---------------------------------------------------------------
    */

    /*
    *------------------------------------
    * Função responsável 
    * pelo service disciplina
    *-----------------------------------
    */
    public function getdisciplina($action = null, $action1 = null)
    {

        //header('Content-Type: application/json; charset=utf-8');
        $disciplina = new \Application\Model\Disciplina;
        $arr_disciplina = $disciplina->getDisciplina($action);
        //var_dump($arr_disciplina);
        echo \json_encode($arr_disciplina, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    }

    /*
    *------------------------------------
    * Função responsável 
    * pelo service disciplina filtro
    *-----------------------------------
    */
    public function getdisciplinafiltro($action = null, $action1 = null)
    {

        //header('Content-Type: application/json; charset=utf-8');
        $disciplina = new \Application\Model\Disciplina;
        $arr_disciplina = $disciplina->getDisciplinaFiltro($action);
        echo \json_encode($arr_disciplina, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    }

        /*
    *------------------------------------
    * Função responsável 
    * pelo service disciplina filtro
    *-----------------------------------
    */
    public function getdisciplinafiltrofeed($action = null, $action1 = null)
    {

        //header('Content-Type: application/json; charset=utf-8');
        $disciplina = new \Application\Model\Disciplina;
        $arr_disciplina = $disciplina->getDisciplinaFiltroFeed($action);
        echo \json_encode($arr_disciplina, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    }


    /*
    *------------------------------------
    * Função responsável 
    * pelo service conteudo
    *-----------------------------------
    */
    public function getconteudo($action = null, $action1 = null)
    {

        //header('Content-Type: application/json; charset=utf-8');
        $conteudo = new \Application\Model\Conteudo;
        $arr_conteudo = $conteudo->getConteudo($action);
        //var_dump($arr_disciplina);
        echo \json_encode($arr_conteudo, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    }


        /*
    *------------------------------------
    * Função responsável 
    * pelo service conteudo filtro
    *-----------------------------------
    */
    public function getconteudofiltro($action = null, $action1 = null)
    {

        //header('Content-Type: application/json; charset=utf-8');
        $conteudo = new \Application\Model\Conteudo;
        $arr_conteudo = $conteudo->getConteudoFiltro($action);
        //var_dump($arr_disciplina);
        echo \json_encode($arr_conteudo, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    }

            /*
    *------------------------------------
    * Função responsável 
    * pelo service conteudo filtro
    *-----------------------------------
    */
    public function getconteudofiltrofeed($action = null, $action1 = null)
    {

        //header('Content-Type: application/json; charset=utf-8');
        $conteudo = new \Application\Model\Conteudo;
        $arr_conteudo = $conteudo->getConteudoFiltroFeed($action);
        //var_dump($arr_disciplina);
        echo \json_encode($arr_conteudo, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    }

    /*
    *------------------------------------
    * Função responsável pelo logout
    *-----------------------------------
    */
    public function logout($action = null, $action1 = null)
    {
        if ($this->session->unsetSession()) {
            header("Location: /");
            exit();
        } else {
            header("Location: /homepage");
            exit();
        }
    }

}