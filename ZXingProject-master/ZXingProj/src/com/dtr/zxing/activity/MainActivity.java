package com.dtr.zxing.activity;

import com.dtr.zxing.R;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.Window;
import android.widget.Button;

public class MainActivity extends Activity{
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		requestWindowFeature(Window.FEATURE_NO_TITLE);
		setContentView(R.layout.main_show);
        Button mButton = (Button) findViewById(R.id.show);  
        mButton.setOnClickListener(new OnClickListener() {  
            @Override  
            public void onClick(View v) {  
                Intent intent = new Intent();  
                intent.setClass(MainActivity.this, CaptureActivity.class);  
                intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);  
                startActivity(intent);  
            }  
        }); 
	}
}
