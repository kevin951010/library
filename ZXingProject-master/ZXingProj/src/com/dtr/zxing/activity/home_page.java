package com.dtr.zxing.activity;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.view.Window;
import android.widget.EditText;
import android.widget.FrameLayout;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;

import com.dtr.zxing.R;
import com.dtr.zxing.activity.CaptureActivity;

import org.w3c.dom.Text;

public class home_page extends Activity {

    boolean isLogin;
    EditText search;

    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home_page);
        search=(EditText)findViewById(R.id.et_keywords);
        Intent getIntent = getIntent();
        isLogin = getIntent.getBooleanExtra("isLogin",false);
    }

    public void GoScan(View v){
        Intent act_Scan = new Intent(this, CaptureActivity.class);
        startActivity(act_Scan);
    }
    
    public void GoSearch(View v){
    	if(search.getText().toString().equals(""))
    	{
    		Toast.makeText(home_page.this, "«Î ‰»ÎÕº È±‡∫≈", Toast.LENGTH_SHORT).show();
    	}
    	else
    	{
            Intent act_Scan = new Intent(this, ResultActivity.class);
            Bundle b=new Bundle();
            b.putString("result",search.getText().toString());
            act_Scan.putExtras(b);
            startActivity(act_Scan);
    	}
    }
}
