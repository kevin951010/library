package com.dtr.zxing.activity;

import java.io.BufferedReader;
import java.io.ByteArrayOutputStream;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;
import java.util.concurrent.Future;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.app.AlertDialog;
import android.app.AlertDialog.Builder;
import android.content.DialogInterface;
import android.content.DialogInterface.OnClickListener;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.dtr.zxing.R;




public class ResultActivity extends Activity {

	private TextView mResultText,bookname,bookauthor,bookpublish,overtime;
	private Gethttp gethttp;
	private ImageView bookpicture;
	private byte[] picByte;
	private Button borrow,giveback;
	ArrayList<String> info=new ArrayList<String>();
	ArrayList<String> receive=new ArrayList<String>();
	HttpClient httpClient =new DefaultHttpClient();
	String line2="https://api.douban.com/v2/book/isbn/",line="",result="",isbn="",booknumber="",line1="http://118.89.45.193/book/summaryfile/";
	Builder builder;
	String overfreeday;
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_result);
		Log.d("fuck","fuck");
		mResultText = (TextView) findViewById(R.id.introduction);
		bookpicture = (ImageView) findViewById(R.id.bookpicture);
		bookname=(TextView) findViewById(R.id.bookname);
		bookauthor=(TextView) findViewById(R.id.bookauthor);
		bookpublish=(TextView) findViewById(R.id.bookpublic);
		overtime=(TextView) findViewById(R.id.overtime);
		Bundle extras = getIntent().getExtras();
		result = extras.getString("result");
		booknumber=result;
		//mResultText.setText(result); 
		builder=new AlertDialog.Builder(this);
		borrow=(Button)findViewById(R.id.borrow);
		giveback=(Button)findViewById(R.id.giveback);
		borrow.setOnClickListener(new MyButton());
		giveback.setOnClickListener(new MyButton());
		
		RecyleIsbnFormServer one=new RecyleIsbnFormServer(handler,booknumber); 
		ExecutorService executor=Executors.newSingleThreadExecutor();
		Future future=executor.submit(one);
		try {
			receive=(ArrayList<String>)future.get();
			Log.d("recylcepassword",isbn);
		} catch (Exception e) {
	// TODO 自动生成的 catch 块
			e.printStackTrace();
		}
		
		if(receive.size()==0)
		{
			mResultText.setText("没有该书本信息");
		}
		else
		{
			isbn=receive.get(3);
			line1=line1+isbn+".txt";
			Log.d("line1",line1);
			line2=line2+isbn;
			Log.d("line2",line2);
			gethttp=new Gethttp();
			gethttp.start();
		}
	}
	
	class MyButton implements View.OnClickListener
	{
		public void onClick(View source)
		{
			
			switch(source.getId())
			{
				case R.id.borrow:
		 			builder.setTitle("用户你好！");
			 		builder.setMessage("确定要借阅书籍吗");
			 		builder.setPositiveButton("确定",new OnClickListener(){
			 			public void onClick(DialogInterface dialog,int which)
			 			{
			 				new Writeinformation(handler).Writeinformation(booknumber);
			 			}
			 		});
		 			builder.setNegativeButton("取消", new OnClickListener()
		 			{
		 				public void onClick(DialogInterface dialog,int which)
		 				{
		 				
		 				}
		 			});
		 			builder.create().show();
		 			break;
				case R.id.giveback:
		 			builder.setTitle("用户你好！");
			 		builder.setMessage("确定要归还书籍吗");
			 		builder.setPositiveButton("确定",new OnClickListener(){
			 			public void onClick(DialogInterface dialog,int which)
			 			{
			 				Giveback one=new Giveback(handler,booknumber); 
							ExecutorService executor=Executors.newSingleThreadExecutor();
							Future future=executor.submit(one);
							try {
								overfreeday=(String)future.get();
								Log.d("overfreeday",overfreeday);
							} catch (Exception e) {
						// TODO 自动生成的 catch 块
								e.printStackTrace();
							}
			 			}
			 		});
		 			builder.setNegativeButton("取消", new OnClickListener()
		 			{
		 				public void onClick(DialogInterface dialog,int which)
		 				{
		 				
		 				}
		 			});
		 			builder.create().show();
		 			break;
			}
		}
	}
	 public class  Gethttp extends Thread 
	    {	
	    	public void run(){
	    	Log.d("mybook","执行");
	    	String line0=null;
				try{
					URL url0 = new URL(line1);
					HttpURLConnection conn0 = (HttpURLConnection) url0.openConnection();
					conn0.setConnectTimeout(60 * 1000);
					conn0.setReadTimeout(60 * 1000);
					Log.d("conn0.getResponseCode",String.valueOf(conn0.getResponseCode()));
	                if (conn0.getResponseCode() == 200) {
	                	InputStream input = conn0.getInputStream();
	                	BufferedReader in = new BufferedReader(new InputStreamReader(input));
	                	String line = null;
	                	StringBuffer sb = new StringBuffer();
	                	while ((line = in.readLine()) != null) {
	                		sb.append(line);
	                	}
							
	                	Log.d("sb",sb.toString());
	                	info=Updatebook(sb.toString());
						Log.d("info1",info.get(1));
						URL url = new URL(info.get(1));
				        HttpURLConnection conn = (HttpURLConnection)url.openConnection();
				        conn.setRequestMethod("GET");
				        conn.setReadTimeout(10000);
				        if (conn.getResponseCode() == 200) {
				                    InputStream fis =  conn.getInputStream();
				                    ByteArrayOutputStream bos = new ByteArrayOutputStream();
				                    byte[] bytes = new byte[1024];
				                    int length = -1;
				                    while ((length = fis.read(bytes)) != -1) {
				                        bos.write(bytes, 0, length);
				                    }
				                    picByte = bos.toByteArray();
				                    bos.close();
				                    fis.close();
				                }
							Message message = new Message();
					        message.what = 3 ;
					        handler.sendMessage(message); 
	                }
	                else
	                {
	                	HttpGet get =new HttpGet(line2);
						get.addHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
						get.addHeader("User-Agent", "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36");
						HttpResponse httpresponse2=httpClient.execute(get);
						HttpEntity entity=httpresponse2.getEntity();
						if(entity!=null) 
						{
							BufferedReader br2=new BufferedReader(new InputStreamReader(entity.getContent()));
							while((line0=br2.readLine())!=null)
							{
								line=line0+line+"\n";
							}
							Log.d("WEATHER","line0");
							info=Updatebook(line);
							Log.d("info1",info.get(1));
							    URL url = new URL(info.get(1));
				                HttpURLConnection conn = (HttpURLConnection)url.openConnection();
				                conn.setRequestMethod("GET");
				                conn.setReadTimeout(10000);
				                 
				                if (conn.getResponseCode() == 200) {
				                    InputStream fis =  conn.getInputStream();
				                    ByteArrayOutputStream bos = new ByteArrayOutputStream();
				                    byte[] bytes = new byte[1024];
				                    int length = -1;
				                    while ((length = fis.read(bytes)) != -1) {
				                        bos.write(bytes, 0, length);
				                    }
				                    picByte = bos.toByteArray();
				                    bos.close();
				                    fis.close();
				                }
							Message message = new Message();
					        message.what = 3 ;
					        handler.sendMessage(message); 
						  }
	                }
				}
				catch(Exception e)
				{
					Log.d("mybook","出错");
					e.printStackTrace();
			   }
			}
	    	
	    	public ArrayList<String> Updatebook(String line)
	        {
	    	ArrayList<String> In = new ArrayList<String>();
	   		String large="",summary="";
	   		try {
	   				JSONObject jo = new JSONObject(line);
	   			    summary = jo.getString("summary");
	   				Log.d("summary",summary);
	   				
	   				JSONObject imagesobj = jo.getJSONObject("images");
	   				large = imagesobj.getString("large");
	   				Log.d("large",large);
	   				
	   				
	   					In.add(summary);
	   					In.add(large);
	   				
	   		} catch (JSONException e) {
	   			// TODO 自动生成的 catch 块
	   			e.printStackTrace();
	   		}
	   			
	   			return In;
	        }
	    }
	 
	 Handler handler = new Handler() { 
	 public void handleMessage(Message msg)
	  {

          switch (msg.what) {  
          case Writeinformation.SEND_SUCCESS:  
              Toast.makeText(ResultActivity.this, "借书成功", Toast.LENGTH_SHORT).show();
              break;  
          case Writeinformation.SEND_FAIL:  
              Toast.makeText(ResultActivity.this, "借书失败", Toast.LENGTH_SHORT).show();
              break;
          case Giveback.SEND_SUCCESS:
        	  Toast.makeText(ResultActivity.this, "还书成功", Toast.LENGTH_SHORT).show();
        	  if(Integer.parseInt(overfreeday)-30>0)
        	  {
        		  int overday=Integer.parseInt(overfreeday)-30;
        		  double overfree=overday*0.1;
        		  overtime.setText("超期"+String.valueOf(overday)+"天，应支付"+String.valueOf(overfree)+"元");
        	  }
              break;
          case Giveback.SEND_FAIL:
        	  Toast.makeText(ResultActivity.this, "还书失败", Toast.LENGTH_SHORT).show();
              break;
          case 3:
			  mResultText.setText(info.get(0));
              if (picByte != null) {
                  Bitmap bitmap = BitmapFactory.decodeByteArray(picByte, 0, picByte.length);
                  bookpicture.setImageBitmap(bitmap);
              } 
              bookname.setText("书名:"+receive.get(0));
              bookauthor.setText("作者:"+receive.get(1));
              bookpublish.setText("出版社:"+receive.get(2));
              break;
          } 
	  }
	 };
	 
	 
}
