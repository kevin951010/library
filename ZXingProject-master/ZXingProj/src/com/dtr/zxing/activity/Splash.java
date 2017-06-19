package com.dtr.zxing.activity;

import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;
import java.util.concurrent.Future;

import android.app.Activity;
import android.content.Intent;
import android.graphics.Paint;
import android.graphics.drawable.Drawable;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.dtr.zxing.R;

public class Splash extends Activity{
	TextView tv_forget_pwd;
    TextView et_username;
    TextView et_password;
    String suser="",spassword="",recylcepassword="";
    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.splash);

    
    }
    //clicked 'login' button
    public void ShowLoginPage(View v){
        setContentView(R.layout.login);
        et_password = (TextView)findViewById(R.id.login_pwd);
        et_username = (TextView)findViewById(R.id.login_username);
        Drawable username_drawable = getResources().getDrawable(R.drawable.ic_person_black_48dp);  
        Drawable password_drawable = getResources().getDrawable(R.drawable.ic_vpn_key_black_48dp);  
        username_drawable.setBounds(0,0,80,80);  
        password_drawable.setBounds(0,0,80,80);  
        et_username.setCompoundDrawables(username_drawable,null,null,null);  
        et_password.setCompoundDrawables(password_drawable,null,null,null);  
        tv_forget_pwd = (TextView)findViewById(R.id.login_tv_forget);
        tv_forget_pwd.getPaint().setFlags(Paint.UNDERLINE_TEXT_FLAG);
        tv_forget_pwd.setClickable(true);
        tv_forget_pwd.setOnClickListener(new OnClickListener() {
       
        	public void onClick(View arg0) {
   
        	Intent intent = new Intent(Splash.this, Forgetpwd.class);     
        	startActivity(intent);
        	}
        	});
    }

    //clicked 'previous' img
    public void BackToSplash(View v){
        setContentView(R.layout.splash);
    }

    //login with id & pwd
    public void GoHomePage(View v){ 
        suser=et_username.getText().toString();
       	spassword=et_password.getText().toString();
    	Log.d("suser",suser);
        Log.d("spassword",spassword);
        if(suser.equals(""))
		{
			Toast.makeText(Splash.this, "请输入用户名,用户名不能为空", Toast.LENGTH_SHORT).show();
		}
		else
		{
			if(spassword.equals(""))
			{
				Toast.makeText(Splash.this, "请输入密码,密码不能为空", Toast.LENGTH_SHORT).show();
			}
			else
			{
				RecyleUserFromServer one=new RecyleUserFromServer(handler1,suser,spassword); 
				ExecutorService executor=Executors.newSingleThreadExecutor();
				Future future=executor.submit(one);
				try {
					recylcepassword=(String)future.get();
				} catch (Exception e) {
			// TODO 自动生成的 catch 块
					e.printStackTrace();
				}
			}
		}
    	
    }

    Handler handler1=new Handler(){  
        public void handleMessage(Message msg) {  
            switch (msg.what) {  
            case RecyleUserFromServer.SEND_SUCCESS:  
                 if(spassword.equals(recylcepassword))
                 {
                	 Toast.makeText(Splash.this, "登录成功", Toast.LENGTH_SHORT).show();
    	        		 Intent login_with_acc=new Intent(Splash.this,home_page.class);
    	        	     login_with_acc.putExtra("isLogin",true);
    	        	     startActivity(login_with_acc);
                 }
                 else
                 {
                	 Toast.makeText(Splash.this, "账号或密码错误", Toast.LENGTH_SHORT).show();
                 }
                 break;  
            case RecyleUserFromServer.SEND_FAIL:  
                 Toast.makeText(Splash.this, "网络有问题，请稍候重试", Toast.LENGTH_SHORT).show();
                 break;   
            }  
        };        
    };
	
}


//  public class Splash extends Activity {
//	   private TextView tv_forget_pwd;
//	    private EditText et_username;
//	    private EditText et_password;
//	    @Override
//	    protected void onCreate(Bundle savedInstanceState) {
//
//	        super.onCreate(savedInstanceState);
//	        setContentView(R.layout.splash);
//
//
//	    }
//	    //clicked 'login' button
//	    public void ShowLoginPage(View v){
//	        setContentView(R.layout.login);
//	        tv_forget_pwd = (TextView)findViewById(R.id.login_tv_forget);
//	        tv_forget_pwd.getPaint().setFlags(Paint.UNDERLINE_TEXT_FLAG);
//			tv_forget_pwd = (TextView)findViewById(R.id.login_tv_forget);
//		        tv_forget_pwd.getPaint().setFlags(Paint.UNDERLINE_TEXT_FLAG);
//		        et_password = (EditText)findViewById(R.id.login_pwd);
//		        et_username = (EditText)findViewById(R.id.login_username);
//		        Drawable username_drawable = getResources().getDrawable(R.drawable.ic_person_black_48dp);  
//		        Drawable password_drawable = getResources().getDrawable(R.drawable.ic_vpn_key_black_48dp);  
//		        username_drawable.setBounds(0,0,80,80);  
//		        password_drawable.setBounds(0,0,80,80); 
//				        et_username.setCompoundDrawables(username_drawable,null,null,null);  
//	        et_password.setCompoundDrawables(password_drawable,null,null,null); 
//	    }
//
//	    //clicked 'previous' img
//	    public void BackToSplash(View v){
//	        setContentView(R.layout.splash);
//	    }
//
//	    //login with id & pwd
//	    public void GoHomePage(View v){
//	        Intent login_with_acc = new Intent(this,ResultActivity .class);
//	        login_with_acc.putExtra("isLogin",true);
//	        startActivity(login_with_acc);
//	    }
//}



