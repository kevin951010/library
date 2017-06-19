package com.dtr.zxing.activity;

import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.Reader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;
import java.util.HashMap;
import java.util.Map;
import java.util.concurrent.Callable;

import android.os.Handler;
import android.util.Log;

public class RecylemessageFromServer implements Callable{
	//private String url="http://10.0.2.2:8080/ReceiveVC/ReceiveVCservlet"; 
	private String url="http://118.89.45.193:8080/ReceiveVC/ReceiveVCservlet";
    public static final int SEND_SUCCESS=0x123;  
    public static final int SEND_FAIL=0x124;  
    private Handler handler; 
    InputStream inputStream=null;
    String str="";
    String phonenumber="";
    public RecylemessageFromServer(Handler handler,String phonenumber) {   
        this.handler=handler; 
        this.phonenumber=phonenumber;
    }     
    
   
    public String call() throws Exception {  
        // TODO Auto-generated method stub 
    	final Map<String, String>map=new HashMap<String, String>(); 
        map.put("phonenumber", phonenumber);
                try {  
                    if (sendPostRequest(map,url,"utf-8")) { 
                   	 Log.d("sendsuccess","登陆成功");
                       handler.sendEmptyMessage(SEND_SUCCESS);//通知主线程数据发送成功  
                   }else { 
                   	 Log.d("sendsuccess","登陆失败");
                   	handler.sendEmptyMessage(SEND_FAIL);
                       //将数据发送给服务器失败  
                   }  
                } catch (Exception e) {  
                    e.printStackTrace();  
                }                 
         return str;
    }  

    private  boolean sendPostRequest( Map<String, String> param,String url,String encoding) throws Exception {  
        // TODO Auto-generated method stub   
    	StringBuffer sb=new StringBuffer(url); 
        if (!url.equals("")&!param.isEmpty()) { 
            sb.append("&");  
            for (Map.Entry<String, String>entry:param.entrySet()) {                 
                sb.append(entry.getKey()+"=");                
                sb.append(URLEncoder.encode(entry.getValue(), encoding));                 
                sb.append("&");  
            }  
            sb.deleteCharAt(sb.length()-1);//删除字符串最后 一个字符“&”  
        } 
    	byte[]data=sb.toString().getBytes();  
    	HttpURLConnection conn=(HttpURLConnection) new URL(url).openConnection();  
        conn.setConnectTimeout(5000);  
        conn.setRequestMethod("POST");//设置请求方式为POST  
        conn.setDoOutput(true);//允许对外传输数据  
        conn.setRequestProperty("Content-Type", "application/x-www-form-urlencoded");// 设置窗体数据编码为名称/值对    
        OutputStream outputStream=conn.getOutputStream();//打开服务器的输入流  
        outputStream.write(data);//将数据写入到服务器的输出流  
        outputStream.flush();  
        if (conn.getResponseCode()==200) {  
        	Log.d("conn","连接正常");
        	inputStream=conn.getInputStream();
        	//对应的字符编码转换 
        	Reader reader = new InputStreamReader(inputStream, "utf-8"); 
        	BufferedReader bufferedReader = new BufferedReader(reader); 
        	String s="";
        	while ((s = bufferedReader.readLine()) != null) { 
        		str=str+s;
        	} 
        	Log.d("Str",str);        	
        	if(str.equals(""))
        	{
        		return false;
        	}
        	else
        	{
        		return true;
        	}
        }  
        else
        {
        	Log.d("conn",String.valueOf(conn.getResponseCode()));
        	return false; 
        }
    }  
}
