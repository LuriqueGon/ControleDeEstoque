<?php

    use MF\Model\Container;


    $user = Container::getModel('usuario');
    $usuarios = $user->getAll(1);

    echo '<pre>';
    // var_dump($usuarios);
    echo '</pre>';

    $meta = Container::getModel('config')->getMeta();
?>

<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Meta de Vendas: <strong><?php echo $meta ?></strong></h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 5%">
                            Position
                        </th>
                        <th style="width: 10%">
                            Falta pra meta
                        </th>
                        <th style="width: 15%">
                            Vendas Efetuadas
                        </th>
                        
                        <th style="width: 20%">
                            Usuario
                        </th>
                        <th>
                            Progesso
                        </th>
                        <th style="width: 15%" class="text-center">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($usuarios as $key => $info){ ?>
                        <tr>
                            <td><?php echo $key+1 ?></td>
                            <td><?php echo  ($meta - $info['quantVendas'])>0 ? $meta - $info['quantVendas'] : 0?></td>
                            <td><a><?php echo  $info['quantVendas']?></a></td>
                            <td>
                                <?php echo $info['Username'] ?>
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <img alt="Avatar" class="table-avatar" src="/dist/img/<?php echo $info['perfil'] ?>">
                                        
                                    </li>
                                </ul>
                            </td>
                            <td class="project_progress">
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="<?php echo ($info['quantVendas'] * 100)/$meta?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ($info['quantVendas'] * 100)/$meta?>%">
                                    </div>
                                </div>
                                <small>
                                    <?php echo (($info['quantVendas'] * 100)/$meta) > 100 ? 100 : (($info['quantVendas'] * 100)/$meta)?>% Complete
                                </small>
                            </td>
                            <td class="project-state">
                                <?php if($info['quantVendas'] >= $meta){ ?>
                                    <span class="badge badge-success">Success</span>
                                <?php }else{?>
                                    <span class="badge badge-danger">Unsuccess</span>
                                <?php }?>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</section>