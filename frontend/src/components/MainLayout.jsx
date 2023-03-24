import { Layout } from "antd";
import React from "react";
const { Header, Content } = Layout;

const MainLayout = ({ children }) => {
  return (
    <Layout className="layout">
      <Header>
        <div className="logo">
          <img src="/scoupy-logo.svg" width={80} />
        </div>
      </Header>
      <Content style={{ padding: "0 50px" }}>
        <div className="site-layout-content">{children}</div>
      </Content>
    </Layout>
  );
};

export default MainLayout;
