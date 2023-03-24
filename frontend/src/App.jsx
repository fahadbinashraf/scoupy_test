import { ConfigProvider } from "antd";
import React from "react";
import HomePage from "./pages/HomePage";
const App = () => {
  return (
    <ConfigProvider
      theme={{
        token: {
          colorPrimary: "#f97f00",
        },
      }}
    >
      <HomePage />
    </ConfigProvider>
  );
};

export default App;
