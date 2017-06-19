package com.dtr.zxing.activity;
import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;
import java.util.concurrent.Future;

import com.dtr.zxing.R;

import android.app.Activity;
import android.content.Intent;
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

public class Forgetpwd extends Activity{
    
	EditText fgnumber,fgphonecode;
	Button fgcode,fgt_next;
	String verificarion;
	protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
		requestWindowFeature(Window.FEATURE_NO_TITLE);
        setContentView(R.layout.forget_pwd);
        fgnumber=(EditText)findViewById(R.id.fgt_phonenumber);
        fgphonecode=(EditText)findViewById(R.id.fgt_phonecode);
        fgcode=(Button)findViewById(R.id.fgt_getcode);
        fgt_next=(Button)findViewById(R.id.fgt_next);
        fgcode.setOnClickListener(new OnClickListener() {
           public void onClick(View arg0) {
        	 
        	 if(fgnumber.getText().toString().equals(""))
        	 {
        		 Toast.makeText(Forgetpwd.this, "手机号不能为空", Toast.LENGTH_SHORT).show();
        	 }
        	 else
        	 {
        	 
        		 	RecylemessageFromServer one=new RecylemessageFromServer(handler,fgnumber.getText().toString()); 
        			ExecutorService executor=Executors.newSingleThreadExecutor();
        			Future future=executor.submit(one);
        			try {
        				verificarion=(String)future.get();
        				Log.d("verificarion",verificarion);
        			} catch (Exception e) {
        		// TODO 自动生成的 catch 块
        				e.printStackTrace();
        			}
        	 }
        	}
        	});
        fgt_next.setOnClickListener(new OnClickListener() {
            
        	public void onClick(View arg0) {
        		if(fgphonecode.getText().toString().equals(verificarion))
        		{
        			Bundle b=new Bundle();
                    b.putString("phonenumber",fgnumber.getText().toString());
                    Intent act_Scan = new Intent(Forgetpwd.this, Resetpwd.class);
                    act_Scan.putExtras(b);
                    startActivity(act_Scan);
        		}
        		else
        		{
        			Toast.makeText(Forgetpwd.this, "验证码不正确", Toast.LENGTH_SHORT).show();
        		}
        	}
        	});
    }
	
    public void BackToSplash(View v){
    	 Intent login_with_acc=new Intent(Forgetpwd.this,Splash.class);
	     startActivity(login_with_acc);
    }
	
	 Handler handler = new Handler() { 
		 public void handleMessage(Message msg)
		  {

	          switch (msg.what) {  
	          
	          } 
		  }
		 };
}
