@extends('layouts.admin')

@section('title',$title)

@section('content')
  
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              
              <style type="text/css">
                  th{
                      text-align:center;
                      vertical-align:middle
                  }
                  
              </style>
              <div class="row ">
                  <div class="col-sm-12">
                      <section class="panel">
                          <header class="panel-heading no-border">
                              添加商品
                          </header>
                          <form action="{{url('good')}}" method="POST">
                           {{csrf_field()}}
                          <table class="table table-bordered">
                              
                              <tr >
                                  <th>分类:</th>
                                  
                                  <td>
                                      <select class="form-control" id="inputPassword2">  
                                        <option  value="请选择">请选择</option>  
                                       
                                       </select>  
                                  </td>
                                 
                              </tr>
                              <tr>
                                  <th>商品名称:</th>
                                  <td>

                                      <input class="form-control" id="inputPassword2" type="text" name="gname">
                                  </td>
                              </tr>
                              <tr>
                                  <th>商品价格:</th>
                                  <td>
                                      <input class="form-control" id="inputPassword2" type="text" name="gprice">
                                  </td>
                              </tr>
                              <tr>
                                  <th>库存:</th>
                                  <td>
                                   
                                      <input class="form-control" id="inputPassword2" type="text" name="goodsNum">
                                  </td>
                              </tr>
                              <tr>
                                  <th>商品图片:</th>
                                  <td>
                                      <input type="file" name="gpic">
                                  </td>
                              </tr>
                               <tr>
                                  <th>商品描述:</th>
                                  <td>
                                      <textarea class="form-control" id="inputPassword2" name="goodsDes"></textarea>
                                  </td>
                              </tr>
                               <tr>
                                  <th>状态:</th>
                                  <td>
                                      <input type="radio" name="gstatus" value="1" checked>新品
                                      <input type="radio" name="gstatus" value="1">上架
                                      <input type="radio" name="gstatus" value="1">下架
                                  </td>
                              </tr>
                              <tr>
                                  <th></th>
                                  <td>
                                      <input style="width:100px;" type="submit" value="提交">
                                      <input style="width:100px;" onclick="history.go(-1)" type="button" value="返回">
                                  </td>
                              </tr>
                             
                              
                          </table>
                      </section>
                  </div>
                  </form>
                  
              <div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                              Advanced Table
                          </header>
                          <table class="table table-striped table-advance table-hover">
                              <thead>
                              <tr>
                                  <th><i class="icon-bullhorn"></i> Company</th>
                                  <th class="hidden-phone"><i class="icon-question-sign"></i> Descrition</th>
                                  <th><i class="icon-bookmark"></i> Profit</th>
                                  <th><i class=" icon-edit"></i> Status</th>
                                  <th></th>
                              </tr>
                              </thead>
                              <tbody>
                              <tr>
                                  <td><a href="#">Vector Ltd</a></td>
                                  <td class="hidden-phone">Lorem Ipsum dorolo imit</td>
                                  <td>12120.00$ </td>
                                  <td><span class="label label-info label-mini">Due</span></td>
                                  <td>
                                      <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                      <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                      <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      <a href="#">
                                          Adimin co
                                      </a>
                                  </td>
                                  <td class="hidden-phone">Lorem Ipsum dorolo</td>
                                  <td>56456.00$ </td>
                                  <td><span class="label label-warning label-mini">Due</span></td>
                                  <td>
                                      <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                      <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                      <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      <a href="#">
                                          boka soka
                                      </a>
                                  </td>
                                  <td class="hidden-phone">Lorem Ipsum dorolo</td>
                                  <td>14400.00$ </td>
                                  <td><span class="label label-success label-mini">Paid</span></td>
                                  <td>
                                      <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                      <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                      <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      <a href="#">
                                          salbal llb
                                      </a>
                                  </td>
                                  <td class="hidden-phone">Lorem Ipsum dorolo</td>
                                  <td>2323.50$ </td>
                                  <td><span class="label label-danger label-mini">Paid</span></td>
                                  <td>
                                      <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                      <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                      <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                  </td>
                              </tr>
                              <tr>
                                  <td><a href="#">Vector Ltd</a></td>
                                  <td class="hidden-phone">Lorem Ipsum dorolo imit</td>
                                  <td>12120.00$ </td>
                                  <td><span class="label label-primary label-mini">Due</span></td>
                                  <td>
                                      <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                      <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                      <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      <a href="#">
                                          Adimin co
                                      </a>
                                  </td>
                                  <td class="hidden-phone">Lorem Ipsum dorolo</td>
                                  <td>56456.00$ </td>
                                  <td><span class="label label-warning label-mini">Due</span></td>
                                  <td>
                                      <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                      <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                      <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                  </td>
                              </tr>
                              <tr>
                                  <td><a href="#">Vector Ltd</a></td>
                                  <td class="hidden-phone">Lorem Ipsum dorolo imit</td>
                                  <td>12120.00$ </td>
                                  <td><span class="label label-success label-mini">Due</span></td>
                                  <td>
                                      <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                      <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                      <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      <a href="#">
                                          Adimin co
                                      </a>
                                  </td>
                                  <td class="hidden-phone">Lorem Ipsum dorolo</td>
                                  <td>56456.00$ </td>
                                  <td><span class="label label-warning label-mini">Due</span></td>
                                  <td>
                                      <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                      <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                      <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                  </td>
                              </tr>
                              <tr>
                                  <td><a href="#">Vector Ltd</a></td>
                                  <td class="hidden-phone">Lorem Ipsum dorolo imit</td>
                                  <td>12120.00$ </td>
                                  <td><span class="label label-info label-mini">Due</span></td>
                                  <td>
                                      <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                      <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                      <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      <a href="#">
                                          Adimin co
                                      </a>
                                  </td>
                                  <td class="hidden-phone">Lorem Ipsum dorolo</td>
                                  <td>56456.00$ </td>
                                  <td><span class="label label-warning label-mini">Due</span></td>
                                  <td>
                                      <button class="btn btn-success btn-xs"><i class="icon-ok"></i></button>
                                      <button class="btn btn-primary btn-xs"><i class="icon-pencil"></i></button>
                                      <button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button>
                                  </td>
                              </tr>
                              </tbody>
                          </table>
                      </section>
                  </div>
              </div>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
  @endsection