package com.dtr.zxing.activity;

import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;
import java.util.concurrent.Future;

import com.dtr.zxing.R;

import android.app.Activity;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.util.Log;
import android.view.View;
import android.view.Window;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class Resetpwd extends Activity{
	
	EditText fgcode,fgcodever;
	Button confire;
	String phonenumber;
	protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
		requestWindowFeature(Window.FEATURE_NO_TITLE);
        setContentView(R.layout.reset_pwd);
        Bundle extras = getIntent().getExtras();
		phonenumber = extras.getString("phonenumber");
        fgcode=(EditText)findViewById(R.id.rst_pwd);
        fgcodever=(EditText)findViewById(R.id.rst_pwd_repeat);
        confire=(Button)findViewById(R.id.rst_confirm);
        confire.setOnClickListener(new OnClickListener() {
           public void onClick(View arg0) {
        	 
        	 if(fgcode.getText().toString().equals(""))
        	 {
        		 Toast.makeText(Resetpwd.this, "请输入密码", Toast.LENGTH_SHORT).show();
        	 }
        	 else
        	 {
        		if(fgcode.getText().toString().length()>15)
        		{
        			Toast.makeText(Resetpwd.this, "密码长度不要超过15", Toast.LENGTH_SHORT).show();
        		}
        		else
        		{
        		 if(fgcodever.getText().toString().equals(""))
        		 {
        			 Toast.makeText(Resetpwd.this, "请再次密码", Toast.LENGTH_SHORT).show();
        		 }
        		 else
        		 {
        			 if(fgcodever.getText().toString().equals(fgcode.getText().toString()))
        			 {
        				 new Resetpassword(handler).Resetpassword(fgcode.getText().toString(),phonenumber);
        			 }
        			 else
        			 {
        				 Toast.makeText(Resetpwd.this, "请再次密码", Toast.LENGTH_SHORT).show();
        			 }
        		 }
        		}
        	 }
        	}
        });
    }
	
	 Handler handler = new Handler() { 
	 public void handleMessage(Message msg)
	  {

         switch (msg.what) {  
         	case Writeinformation.SEND_SUCCESS:  
         		Toast.makeText(Resetpwd.this, "修改密码成功", Toast.LENGTH_SHORT).show();
         		break;  
         	case Writeinformation.SEND_FAIL:  
         		Toast.makeText(Resetpwd.this, "修改密码失败", Toast.LENGTH_SHORT).show();
         		break;
         } 
	  }
	 };
}
