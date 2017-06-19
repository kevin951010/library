package com.dtr.zxing.activity;

import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.Reader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;
import java.util.concurrent.Callable;

import android.os.Handler;
import android.util.Log;

public class RecyleIsbnFormServer implements Callable{
	//private String url="http://10.0.2.2:8080/Isbn/Isbnservlet"; 
	private String url="http://118.89.45.193:8080/Isbn/Isbnservlet"; 
    public static final int SEND_SUCCESS=0x123;  
    public static final int SEND_FAIL=0x124;  
    private Handler handler; 
    InputStream inputStream=null;
    String str="";
    String booknumber="";
    ArrayList<String> info=new ArrayList<String>();
    public RecyleIsbnFormServer(Handler handler,String booknumber) {   
        this.handler=handler; 
        this.booknumber=booknumber;
    }     
    
   
    public ArrayList<String> call() throws Exception {  
        // TODO Auto-generated method stub 
    	final Map<String, String>map=new HashMap<String, String>(); 
        map.put("booknumber", booknumber);
        Log.d("booknumber",booknumber);
        sendPostRequest(map,url,"utf-8");
        return info;
    }  

    private  void sendPostRequest( Map<String, String> param,String url,String encoding) throws Exception {  
        // TODO Auto-generated method stub   
    	StringBuffer sb=new StringBuffer(url); 
        if (!url.equals("")&!param.isEmpty()) { 
            sb.append("&");  
            for (Map.Entry<String, String>entry:param.entrySet()) {                 
                sb.append(entry.getKey()+"=");                
                sb.append(URLEncoder.encode(entry.getValue(), encoding));                 
                sb.append("&");  
            }  
            sb.deleteCharAt(sb.length()-1);//ɾ���ַ������ һ���ַ���&��  
        } 
    	byte[]data=sb.toString().getBytes();  
    	HttpURLConnection conn=(HttpURLConnection) new URL(url).openConnection();  
        conn.setConnectTimeout(5000);  
        conn.setRequestMethod("POST");//��������ʽΪPOST  
        conn.setDoOutput(true);//������⴫������  
        conn.setRequestProperty("Content-Type", "application/x-www-form-urlencoded");// ���ô������ݱ���Ϊ����/ֵ��    
        OutputStream outputStream=conn.getOutputStream();//�򿪷�������������  
        outputStream.write(data);//������д�뵽�������������  
        outputStream.flush();  
        if (conn.getResponseCode()==200) {  
        	Log.d("conn","��������");
        	inputStream=conn.getInputStream();
        	//��Ӧ���ַ�����ת�� 
        	Reader reader = new InputStreamReader(inputStream, "utf-8"); 
        	BufferedReader bufferedReader = new BufferedReader(reader); 
        	String s="";
        	while ((s = bufferedReader.readLine()) != null) { 
        		info.add(s);
        	} 
        }  
        else
        {
        	Log.d("conn",String.valueOf(conn.getResponseCode())); 
        }
    }  
}
