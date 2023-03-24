import { EyeInvisibleOutlined } from "@ant-design/icons";
import { Avatar, Card } from "antd";
import React from "react";
const { Meta } = Card;

const CouponCard = ({ item }) => {
  return (
    <Card
      className="coupon-card"
      cover={
        <img
          alt={item.title}
          src={`https://assets.scoupy.nl/images/${item.image}`}
        />
      }
      actions={[
        <span>
          <EyeInvisibleOutlined /> Hide
        </span>,
      ]}
    >
      <Meta
        avatar={
          <Avatar src={`https://assets.scoupy.nl/images/${item.client_icon}`} />
        }
        title={item.title}
        description={item.retailer_availability_label || ""}
      />
    </Card>
  );
};

export default CouponCard;
