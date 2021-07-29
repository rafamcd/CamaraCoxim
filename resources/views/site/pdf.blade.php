@extends('site.layout')

@section('content')
<div id="pagina-interna">
        <table>
            <tr>
                <td align="left"><span class='tnoticias cor'>{{$descricao}}</span><br>
                <br /><br />
                <div align="center">
                    <?php 
                    
                    if (isset($_GET['data1']) && !$_GET['data1'] != '0000-00-00') {
                        $valordata1 = $_GET['data1'];
                    }  else  {
                        $valordata1 = '1900-01-01';
                    }
                    if (isset($_GET['data2']) && !$_GET['data2'] != '0000-00-00') {
                        $valordata2 = $_GET['data2'];
                    }  else  {
                        $valordata2 = date('Y-m-d');
                    }
                        
                    ?>
                    
                <form method="GET" action="{{route('pdfbusca', ['categoria'=>$categoria])}}">                    
                    <div id="box-tit-desc"> 
                        <span class="titnoticia">Buscar Documentos<br/> 
                    Data &nbsp;&nbsp; <input type="date" name="data1" value="<?php echo $valordata1; ?>"> &nbsp;&nbsp;até&nbsp;&nbsp; 
                    <input type="date" name="data2" id="data2" value="<?php echo $valordata2; ?>">
                    <input type="submit" class="btnpadrao" value="Filtrar" style="width: 70px; height: 40px; padding:0; margin: 0; line-height: 40px; " /> 
                    </span>
                    </div>
                    
                </form>   
                    <hr style="width: 80%; color: #4169E1; height: 1px; background-color:#4169E1;" /><br/>
                </div>
               
        
        <div id="box">
            
        <!-- conteudo -->    
        <table width='900' border='0' cellpadding='4' cellspacing='0'>
                @foreach($registrosPDF as $r)

                        <TR valign="top"> 
                                <TD valign="middle">
                                <a href="{{asset('media/pdf/'.$r->categoria.'/'.$r->arquivo)}}" target="_blank">
                                                <img src='/media/images/template2/diario.png' class="curvas bw" style="float:left; margin-right:15px;">
                                        </a>
                                        <div id="box-tit-not" class="cor"> <?php echo date('d/m/Y', strtotime($r->data_documento)); ?></div>
                                        <div id="box-tit-desc"> 
                                        <span class="titnoticia">
                                                <a href="{{asset('media/pdf/'.$r->categoria.'/'.$r->arquivo)}}" target="_blank">
                                                {{$r->titulo}}
                                        </span>
                                        </div>
                                </TD>
                        </TR>
                        <tr>
                        <td><div class="linha"></div></td>
                        </tr>

                @endforeach         
                          
                      
                
        </table>
        
        
               
                {{$registrosPDF->links()}}
               
                
        
        <!-- fim conteudo -->
         
        
        </div>
        
        
        
        
                </td>
                
            </tr>
            
        </table>
        </div>


@endsection